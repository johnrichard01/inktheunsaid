<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->string('recipient')->nullable();
        // Add other columns or modifications as needed
    });
}

public function down()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->dropColumn('recipient');
    });
}


};
