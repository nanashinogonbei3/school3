<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeInstructorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            // profile、introduction、img、profession カラムをNULL許可にする
            $table->string('profile',255)->nullable()->change();
            $table->string('introduction',255)->nullable()->change();
            $table->string('img',255)->nullable()->change();
            $table->string('profession',255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn('profile');
            $table->dropColumn('introduction');
            $table->dropColumn('img');
            $table->dropColumn('profession');
        });
    }
}
