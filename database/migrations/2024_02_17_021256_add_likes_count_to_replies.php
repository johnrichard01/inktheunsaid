<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLikesCountToReplies extends Migration
{
    public function up()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->unsignedInteger('likes_count')->default(0);
        });
    }

    public function down()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->dropColumn('likes_count');
        });
    }
}
