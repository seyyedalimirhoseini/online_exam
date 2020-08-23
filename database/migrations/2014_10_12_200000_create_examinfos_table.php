<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinfos', function (Blueprint $table) {
            $table->id();
            $table->integer('question_number');
            $table->string('time');
//            $table->integer('status')->default(0);
            $table->bigInteger('session_id')->unsigned()->unique();
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->string('unique_id');
            $table->integer('final_exam')->nullable();
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
        Schema::dropIfExists('examinfos');
    }
}
