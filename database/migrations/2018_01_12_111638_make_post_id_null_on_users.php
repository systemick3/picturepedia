<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePostIdNullOnUsers extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
  */
  public function up()
  {
    Schema::table('files', function (Blueprint $table) {
      $table->integer('post_id')->unsigned()->nullable()->default(NULL)->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
  */
  public function down()
  {
    Schema::table('files', function (Blueprint $table) {
      $table->integer('post_id')->unsigned()->nullable(false)->change();
    });
  }
}
