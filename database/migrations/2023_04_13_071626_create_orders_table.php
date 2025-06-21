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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invocie_id');
            $table->double('amount');
            $table->string('currency_name');
            $table->string('currency_icon');
            $table->integer('product_qty');
            $table->string('payment_method');
            $table->integer('payment_status');
            $table->text('coupon');
            $table->string('order_status');
            $table->string('user_name'); // for pickup
            $table->string('user_phone'); // for pickup
            $table->string('user_email')->nullable(); // customer email
            $table->text('notes')->nullable(); // special instructions
            $table->string('payment_proof')->nullable(); // for uploaded proof
            $table->unsignedBigInteger('vendor_id')->nullable(); // link to vendor
            $table->json('products')->nullable(); // store purchased products
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
