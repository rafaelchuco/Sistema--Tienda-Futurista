<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('categorias', function (Blueprint $table) {
        $table->boolean('estado')->default(1);
    });
}

public function down()
{
    Schema::table('categorias', function (Blueprint $table) {
        $table->dropColumn('estado');
    });
}

};
