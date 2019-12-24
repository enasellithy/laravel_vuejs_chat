<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('user_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('device_token')->nullable();
            $table->string('device_type')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('type')->default(1);
            $table->string('balance')->nullable();
            $table->string('rate')->nullable();
            $table->string('image')->nullable();
            $table->string('car_type')->nullable();
            $table->string('car_number')->nullable();
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            $table->string('personal_id')->nullable();
            $table->string('car_licence')->nullable();
            $table->string('driving_liecence')->nullable();
            $table->string('work_permission')->nullable();
            $table->tinyInteger('online')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
