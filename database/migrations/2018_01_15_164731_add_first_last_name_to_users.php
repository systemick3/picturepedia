<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirstLastNameToUsers extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
  */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->string('first_name', 255)->nullable()->after('name')->default('');
      $table->string('last_name', 255)->nullable()->after('first_name')->default('');
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
      $table->dropColumn('first_name');
      $table->dropColumn('last_name');
    });
  }
}
