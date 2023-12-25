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
            $table->smallInteger('status')->default(1);
            $table->string('name', 100)->index();
            $table->string('artist', 100);
            $table->string('category', 100)->nullable();
            $table->integer('price');
            $table->string('detail', 500)->nullable();
            $table->string('image_name')->nullable();
            $table->integer('quantity')->default(0);
            $table->unsignedBigInteger('last_updated_by')->nullable(); // nullable() を追加
            $table->timestamps();
            $table->softDeletes();

            // 外部キー制約
            $table->foreign('last_updated_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
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
