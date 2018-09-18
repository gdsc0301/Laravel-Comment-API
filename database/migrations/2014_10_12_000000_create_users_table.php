<?php

use App\User;
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
      /**
       * ComMeeting API
       *
       * Create the 'users' table.
       */
        Schem
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            //Emails are unique.
            $table->string('email', 32)->unique();
            //Avatars can be null
            $table->binary('avatar')->nullable(true);
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
