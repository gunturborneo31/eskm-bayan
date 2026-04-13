<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds `username` and `keterangan` (role) columns to the users table.
 *
 * - username: used instead of email for the legacy dashboard login because
 *   accounts are identified by short codes (ortal, umum, pbj, …).
 * - keterangan: role code that controls which departments a user can view.
 *   Values: admin | ortal | umum | pemerintahan | adbang | prokopim | kesra
 *           | pbj | ekosda | hukum | asisten1 | asisten2 | asisten3
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'username')) {
                $table->string('username', 50)->nullable()->unique()->after('name');
            }
            if (! Schema::hasColumn('users', 'keterangan')) {
                $table->string('keterangan', 50)->nullable()->after('username');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(array_filter(['username', 'keterangan'], fn ($col) => Schema::hasColumn('users', $col)));
        });
    }
};
