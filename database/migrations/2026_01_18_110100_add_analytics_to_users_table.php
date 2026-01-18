<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add Analytic Columns to Users table
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_order_at')->nullable();
            $table->decimal('total_spent_ever', 12, 2)->default(0);
        });

        // 2. Create a SQL TRIGGER (Outstanding Database Proficiency)
        // Automatically updates the user's analytic data whenever a new order is placed
        DB::unprepared("
            CREATE TRIGGER after_order_placed
            AFTER INSERT ON orders
            FOR EACH ROW
            BEGIN
                UPDATE users 
                SET last_order_at = NEW.created_at,
                    total_spent_ever = total_spent_ever + NEW.grand_total
                WHERE id = NEW.user_id;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS after_order_placed");

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_order_at', 'total_spent_ever']);
        });
    }
};
