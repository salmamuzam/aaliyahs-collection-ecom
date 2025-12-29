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
            // product_id from the product table
           // $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // user_id from the user table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
           // $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');
         //   $table->integer('quantity')->default(1);
        //    $table->decimal('price_per_item', 10, 2);
        //    $table->decimal('total_price', 10, 2);

        // new added one
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->enum('status', ['new', 'processing', 'shipped','delivered', 'cancelled'])->default('new');
            $table->string('currency')->default('lkr');
            $table->decimal('shipping_amount', 10, 2)->nullable();
            $table->string('shipping_method')->nullable();
            $table->text('notes')->nullable();
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
