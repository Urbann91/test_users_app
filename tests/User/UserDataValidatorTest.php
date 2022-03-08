<?php

namespace Tests\User;

use App\Validator\UserDataValidator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UserDataValidatorTest extends TestCase
{
    /**
     * @var UserDataValidator
     */
    protected $userDataValidator;

    public function setUp(): void
    {
        parent::setUp();
        $this->userDataValidator = new UserDataValidator();
    }

    /**
     * @dataProvider rulesValues
     */
    public function testRulesViolation(array $attributes, array $assertMessage)
    {
        try {
            $this->userDataValidator->isPassed($attributes);
        } catch (ValidationException $exception) {
            $this->assertEquals($assertMessage, $exception->errors());
            return;
        }

        $this->fail('ValidationException was not thrown');
    }

    public function testRulesViolationAboutBlackLists()
    {
        config()->set('rules.black_list.name', 'blackname1,blackname2');
        config()->set('rules.black_list.email', 'blackEmail1@gmail.com,blackEmail2@gmail.com');

        try {
            $this->userDataValidator->isPassed(['name' => 'blackname1', 'email' => 'blackEmail2@gmail.com']);
        } catch (ValidationException $exception) {
            $this->assertEquals('The selected name is invalid.', $exception->errors()['name'][0]);
            $this->assertEquals('The selected email is invalid.', $exception->errors()['email'][0]);
            return;
        }

        $this->fail('ValidationException was not thrown');
    }

    /**
     * @return array[]
     */
    public function rulesValues()
    {
        return [
            [
                [
                    'name' => 'Ф'
                ],
                [
                    'name' => [
                        'The name format is invalid.',
                        'The name must be at least 8 characters.',
                    ]
                ]
            ],
            [
                [
                    'name' => 'ФФФФФФФ'
                ],
                [
                    'name' => [
                        'The name format is invalid.',
                        'The name must be at least 8 characters.',
                    ]
                ]
            ],
            [
                [
                    'name' => str_repeat('ФФФФФФФФ', 10)
                ],
                [
                    'name' => [
                        'The name format is invalid.',
                        'The name may not be greater than 64 characters.',
                    ]
                ]
            ],
            [
                [
                    'email' => 'тест@google.com'
                ],
                [
                    'email' => [
                        'The email must be a valid email address.',
                    ]
                ]
            ],
            [
                [
                    'email' => 'test@'
                ],
                [
                    'email' => [
                        'The email must be a valid email address.',
                    ]
                ]
            ],
            [
                [
                    'email' => 'test@gmail.kz'
                ],
                [
                    'email' => [
                        'The email must be a valid email address.',
                    ]
                ]
            ],
            [
                [
                    'email' => 'test@111111111gmail.com'
                ],
                [
                    'email' => [
                        'The email must be a valid email address.',
                    ]
                ]
            ],
        ];
    }
}
