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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();

            $table->foreignId('room_id')->nullable()
            ->constrained('rooms')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->string('item_name');
            $table->enum('category', ['elektronik', 'rumah tangga', 'kendaraan', 'lainnya']);
            $table->enum('condition', ['good', 'broke', 'maintenance']);
            $table->integer('stok');
            $table->string('image');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
