<?php

use App\Comment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
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
       * Create the 'comments' table.
       */
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')
                    //Defines a foreign key between,
                    //the user 'id' and the comment 'author_id'.
                    ->references('id')
                    ->on('users')
                    //When an user is deleted,
                    //their comments goes too.
                    ->onDelete('cascade');
            $table->text('current_text')->nullable(false);
            $table->enum('edited', ['yes','no'])->default('no');
            $table->text('history', 65000)->nullable(true);
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
        Schema::dropIfExists('comments');
    }
}
