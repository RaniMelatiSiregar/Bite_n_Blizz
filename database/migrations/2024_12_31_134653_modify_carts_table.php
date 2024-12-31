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
        Schema::table('carts', function (Blueprint $table) {
            // Drop kolom lama
            $table->dropColumn(['product_name', 'price', 'image']);
            
            // Tambah kolom baru
            $table->foreignId('product_id')->after('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // Rollback perubahan
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            
            $table->string('product_name');
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
        });
    }
};
