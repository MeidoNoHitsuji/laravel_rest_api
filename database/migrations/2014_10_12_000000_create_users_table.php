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
            $table->string('image')->default('');
            $table->string('about')->default('');
            $table->string('type');
            $table->string('github');
            $table->string('city');
            $table->boolean('is_finished')->default(false);
            $table->string('phone');
            $table->string('birthday');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_reset_token')->nullable();
            $table->integer('worker_id')->default(0);
            $table->integer('role')->default(0); //Можно было бы сделать через отдельную траблицу ролей, но для ТЗ сделаем так.
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
