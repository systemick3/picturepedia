<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('hashtags', function (Blueprint $table) {
      $table->increments('id');
      $table->string('hashtag')->nullable(false);
      $table->integer('count')->unsigned()->nullable(false);
      $table->timestamps();
      $table->unique(['hashtag']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('hashtags');
  }
}
