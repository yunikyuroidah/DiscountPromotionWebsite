<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->dropColumn('image_path');
        });

        // Gunakan raw SQL untuk LONGBLOB karena Blueprint::binary() hanya membuat BLOB biasa
        DB::statement('ALTER TABLE products ADD COLUMN image LONGBLOB NULL');
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->dropColumn('image');
            $table->string('image_path')->nullable();
        });
    }
};
