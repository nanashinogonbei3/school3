<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('instructor_id')->comment('インストラクターID');
            $table->string('lesson_name')->comment('レッスン名');
            $table->string('describe')->comment('レッスンの説明');
            $table->string('lesson_time')->comment('レッスン時間');
            $table->date('event_date')->comment('開催日');
            $table->integer('fee')->comment('レッスン料金');
            $table->integer('capacity')->comment('定員人数');
            $table->string('img')->comment('イメージ画像');
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
        Schema::dropIfExists('lessons');
    }
}
