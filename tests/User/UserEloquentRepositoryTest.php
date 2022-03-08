<?php

namespace Tests\User;

use App\Models\User;
use App\Repository\Eloquent\UserRepository;
use App\Validator\UserDataValidator;
use App\Validator\UserDataValidatorInterface;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Mockery;
use Tests\TestCase;

class UserEloquentRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public const TEST_BOX = ['name' => 'name', 'email' => 'email', 'notes' => 'notes'];

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->disableDataValidator();
    }

    public function testGetAll()
    {
        $newCount = 3;
        $initCount = User::count();

        User::factory()->count($newCount)->create();

        $this->assertEquals($initCount + $newCount, $this->userRepository->all()->count());
    }

    public function testCreate()
    {
        /** @var User $model */
        $model = $this->userRepository->create(static::TEST_BOX);

        $this->assertEquals(static::TEST_BOX['name'], $model->name);
        $this->assertEquals(static::TEST_BOX['email'], $model->email);
        $this->assertEquals(static::TEST_BOX['notes'], $model->notes);
    }

    public function testFindById()
    {
        $user = User::factory()->create();

        /** @var User $model */
        $model = $this->userRepository->find($user->id);

        $this->assertEquals($user->id, $model->id);
    }

    public function testUpdate()
    {
        /** @var User $user */
        $user1 = User::factory()->create();

        /** @var User $model */
        $this->userRepository->update($user1->id, static::TEST_BOX);

        $user2 = $this->userRepository->find($user1->id);

        $this->assertEquals($user1->id, $user2->id);
        $this->assertNotEquals($user1->name, $user2->name);
        $this->assertNotEquals($user1->email, $user2->email);
        $this->assertNotEquals($user1->notes, $user2->notes);
        $this->assertEquals(static::TEST_BOX['name'], $user2->name);
        $this->assertEquals(static::TEST_BOX['email'], $user2->email);
        $this->assertEquals(static::TEST_BOX['notes'], $user2->notes);
        $this->assertEquals($user1->created_at->toDateTimeString(), $user2->created_at->toDateTimeString());
        $this->assertEquals($user1->deleted_at, $user2->deleted_at);
    }

    public function testSoftDeleteById()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->assertNotEmpty($this->userRepository->find($user->id));

        /** @var User $model */
        $this->userRepository->delete($user->id);

        $this->assertEmpty($this->userRepository->find($user->id));
    }

    /**
     * @return $this
     */
    protected function setBaseClass(): self
    {
        $this->userRepository = app(UserRepository::class);

        return $this;
    }

    /**
     * Тестируем UserRepository, поэтому dataValidator выключаем, подкидывая мок.
     * Для него есть персональный юнит-тест @see UserDataValidatorTest
     */
    protected function disableDataValidator(): void
    {
        $this->app->bind(UserDataValidatorInterface::class, function () {
            $mock = Mockery::mock(UserDataValidator::class);
            $mock->makePartial();
            $mock->shouldReceive('rules')
                ->withAnyArgs()
                ->andReturn([]);

            return $mock;
        });

        $this->setBaseClass();
    }
}
