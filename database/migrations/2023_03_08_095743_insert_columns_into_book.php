<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertColumnsIntoBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 
        Schema::table('books', function (Blueprint $table) {
            $table->string("tacgia")->after("soluong");
            $table->longText("mota")->after("ten");
            $table->text("noidungsach")->after("danhmuc");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('shop_users', function (Blueprint $table) {
            $table->dropColumn(['tacgia',  'mota','noidungsach']);
        });
    }
}