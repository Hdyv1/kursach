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
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('device_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_email');
            $table->text('description');
            $table->enum('status', ['new', 'in_progress', 'done'])->default('new');
            $table->integer('final_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_orders');
    }
};
