<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileIdToUsers extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
  */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->integer('file_id')->unsigned()->nullable();
      $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
  */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropForeign('users_file_id_foreign');
      $table->dropColumn('file_id');
    });
  }
}
