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
        Schema::table('products', function (Blueprint $table) {
            $table->json('images')->nullable()->after('price');
        });

        // Migrate existing data if needed, but since we are changing column name and type, 
        // we'll just drop the old column and use the new one.
        // Or better, keep the data:
        foreach (\App\Models\Product::all() as $product) {
            $product->images = [$product->image];
            $product->save();
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image')->after('price')->nullable();
        });

        foreach (\App\Models\Product::all() as $product) {
            if (!empty($product->images)) {
                $product->image = $product->images[0];
                $product->save();
            }
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};
