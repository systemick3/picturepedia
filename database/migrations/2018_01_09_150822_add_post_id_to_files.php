<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostIdToFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('files', function (Blueprint $table) {
        $table->integer('post_id')->unsigned()->after('id');
        $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
        $table->dropForeign('files_post_id_foreign');
        $table->dropColumn('post_id');
      });
    }
}
