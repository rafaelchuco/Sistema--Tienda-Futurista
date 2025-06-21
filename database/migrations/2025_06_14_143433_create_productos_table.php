<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto'); // int auto_increment
            $table->string('nombre'); // varchar(255)
            $table->string('marca', 100)->nullable(); // varchar(100), puede ser NULL
            $table->decimal('precio', 10, 2); // decimal(10,2)
            $table->integer('stock')->default(0); // default 0
            $table->boolean('estado')->default(1); // tinyint(1), default 1
            $table->unsignedBigInteger('id_categoria')->nullable(); // FK, puede ser NULL
            $table->timestamps(); // created_at, updated_at

            $table->foreign('id_categoria')
                  ->references('id_categoria')
                  ->on('categorias')
                  ->onDelete('set null'); // Si se elimina la categoría, poner NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
