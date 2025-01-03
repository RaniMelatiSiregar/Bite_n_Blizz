<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('referral_code')->unique();
            $table->integer('referral_count')->default(0);
            $table->decimal('commission_rate', 5, 2)->default(5.00); // Persentase komisi
            $table->decimal('total_earnings', 10, 2)->default(0.00);
            $table->decimal('available_balance', 10, 2)->default(0.00);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tambah kolom referrer_id dan referral_code di tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('referrer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('used_referral_code')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['referrer_id']);
            $table->dropColumn(['referrer_id', 'used_referral_code']);
        });
        
        Schema::dropIfExists('affiliates');
    }
}; 