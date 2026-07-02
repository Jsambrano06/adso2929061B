<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('pets') || !Schema::hasColumn('pets', 'image')) {
            return;
        }

        DB::statement('ALTER TABLE pets MODIFY image LONGTEXT NULL');
    }

    public function down(): void
    {
        if (!Schema::hasTable('pets') || !Schema::hasColumn('pets', 'image')) {
            return;
        }

        DB::statement('ALTER TABLE pets MODIFY image VARCHAR(255) NULL');
    }
};
