<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_code')->unique();
            $table->string('customer_name');
            $table->string('whatsapp_number', 20);
            $table->decimal('weight', 8, 2);
            $table->unsignedInteger('total_price');
            $table->enum('status', ['received', 'washing', 'drying', 'ironing', 'ready'])->default('received')->index();
            $table->dateTime('estimated_ready_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
