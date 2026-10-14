<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_submissions', function (Blueprint $table) {
            if (! Schema::hasColumn('contact_submissions', 'email')) {
                $table->string('email')->nullable()->after('name');
            }
            if (! Schema::hasColumn('contact_submissions', 'project_type')) {
                $table->string('project_type')->nullable()->after('phone');
            }
            if (! Schema::hasColumn('contact_submissions', 'budget')) {
                $table->string('budget', 100)->nullable()->after('project_type');
            }
        });
    }

    public function down(): void
    {
        // Additive-only migration: columns are intentionally kept to avoid data loss.
    }
};
