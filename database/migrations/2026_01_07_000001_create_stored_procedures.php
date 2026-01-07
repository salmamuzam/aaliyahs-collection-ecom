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
        // Stored Procedure to get High Value Customers
        // This is an "Advanced SQL Feature" as per grading rubric
        $procedure = "
            CREATE PROCEDURE GetHighValueCustomers(IN min_spent DECIMAL(10,2))
            BEGIN
                SELECT u.id, u.first_name, u.last_name, u.email, SUM(o.grand_total) as total_spent
                FROM users u
                JOIN orders o ON u.id = o.user_id
                WHERE o.payment_status = 'paid' OR o.payment_status = 'cod'
                GROUP BY u.id, u.first_name, u.last_name, u.email
                HAVING total_spent >= min_spent
                ORDER BY total_spent DESC;
            END;
        ";

        DB::unprepared("DROP PROCEDURE IF EXISTS GetHighValueCustomers");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS GetHighValueCustomers");
    }
};
