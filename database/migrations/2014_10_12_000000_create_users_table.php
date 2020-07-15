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
            $table->string('login')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image');
            $table->string('about');
            $table->string('type');
            $table->string('github');
            $table->string('city');
            $table->boolean('is_finished');
            $table->string('phone')->unique();
            $table->string('birthday');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role'); //Можно было бы сделать через отдельную траблицу ролей, но для ТЗ сделаем так.
            $table->rememberToken();
            $table->timestamps();
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
