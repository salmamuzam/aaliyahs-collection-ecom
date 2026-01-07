<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Index for status filtering (very common in Admin/MyOrders)
            $table->index('status');
            // Index for payment status (optional but good for filtering)
            $table->index('payment_status');
            // Index for created_at (used for 'latest()' and sorting)
            $table->index('created_at');
        });

        Schema::table('products', function (Blueprint $table) {
            // Index for price filtering (range queries)
            $table->index('price');
            // Index for name (search); composite index could be better but this is a good start
            $table->index('name');
        });

        Schema::table('addresses', function (Blueprint $table) {
            // Index searching by email or names
            $table->index(['first_name', 'last_name']);
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['payment_status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['price']);
            $table->dropIndex(['name']);
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->dropIndex(['first_name', 'last_name']);
            $table->dropIndex(['email']);
        });
    }
};
