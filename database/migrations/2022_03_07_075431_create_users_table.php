<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('email', 256);
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes('deleted_at');

           /* Из задания не понятно как должны сочетаться удаленные через
            soft-delete записи и уникальные поля в DDL схеме. Поэтому нельзя создать пользователя с именем (email),
            которое ранее было использовано удаленным.*/

            $table->unique(['email']);
            $table->unique(['name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
