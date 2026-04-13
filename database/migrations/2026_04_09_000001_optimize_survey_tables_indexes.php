<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Adds missing query-critical indexes to the legacy year-named survey tables.
 *
 * Every analytics query filters by jenisPelayanan + created_at range.
 * Without a composite index those run as full-table scans.
 */
return new class extends Migration
{
    /** Year tables that exist now or may appear in the future. */
    private array $surveyTables = ['2023', '2024'];

    public function up(): void
    {
        foreach ($this->surveyTables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            // Composite index for the core analytics filter pattern:
            // WHERE jenisPelayanan IN (…) AND created_at BETWEEN … AND …
            if (! $this->indexExists($table, 'idx_dept_created')) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->index(['jenisPelayanan', 'created_at'], 'idx_dept_created');
                });
            }

            // Stand-alone index on created_at for monthly aggregation queries.
            if (! $this->indexExists($table, 'idx_created_at')) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->index('created_at', 'idx_created_at');
                });
            }
        }

        // Fix the 2024 updated_at column: it was stored as varchar(100)
        // which breaks Eloquent automatic timestamp management.
        if (Schema::hasTable('2024') && Schema::hasColumn('2024', 'updated_at')) {
            $type = $this->columnType('2024', 'updated_at');

            if (str_contains(strtolower($type), 'varchar')) {
                // Null out the invalid '0000-00-00 00:00:00' sentinel values first.
                DB::table('2024')
                    ->where('updated_at', '0000-00-00 00:00:00')
                    ->orWhere('updated_at', '')
                    ->update(['updated_at' => null]);

                Schema::table('2024', function (Blueprint $blueprint) {
                    $blueprint->timestamp('updated_at')->nullable()->change();
                });
            }
        }

        // Add foreign key constraint between survey rows and their sub-type.
        // Done with SET NULL on delete so we don't lose survey data when a
        // sub-jenis entry is removed.
        if (
            Schema::hasTable('2024')
            && Schema::hasTable('sub_jenis')
            && Schema::hasColumn('2024', 'id_sub_jenis')
            && ! $this->foreignKeyExists('2024', 'fk_2024_sub_jenis')
        ) {
            // Remove orphaned references before adding the constraint.
            $validIds = DB::table('sub_jenis')->pluck('id');
            DB::table('2024')
                ->whereNotNull('id_sub_jenis')
                ->whereNotIn('id_sub_jenis', $validIds)
                ->update(['id_sub_jenis' => null]);

            Schema::table('2024', function (Blueprint $blueprint) {
                $blueprint->foreign('id_sub_jenis', 'fk_2024_sub_jenis')
                    ->references('id')
                    ->on('sub_jenis')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        foreach ($this->surveyTables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if ($this->indexExists($table, 'idx_dept_created')) {
                    $blueprint->dropIndex('idx_dept_created');
                }

                if ($this->indexExists($table, 'idx_created_at')) {
                    $blueprint->dropIndex('idx_created_at');
                }
            });
        }

        if (
            Schema::hasTable('2024')
            && $this->foreignKeyExists('2024', 'fk_2024_sub_jenis')
        ) {
            Schema::table('2024', function (Blueprint $blueprint) {
                $blueprint->dropForeign('fk_2024_sub_jenis');
            });
        }
    }

    private function indexExists(string $table, string $indexName): bool
    {
        $indexes = DB::select("SHOW INDEX FROM `{$table}` WHERE Key_name = ?", [$indexName]);

        return count($indexes) > 0;
    }

    private function foreignKeyExists(string $table, string $constraintName): bool
    {
        $result = DB::select(
            "SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS
             WHERE TABLE_NAME = ? AND CONSTRAINT_NAME = ? AND TABLE_SCHEMA = DATABASE()",
            [$table, $constraintName]
        );

        return count($result) > 0;
    }

    private function columnType(string $table, string $column): string
    {
        $result = DB::select(
            "SELECT DATA_TYPE FROM information_schema.COLUMNS
             WHERE TABLE_NAME = ? AND COLUMN_NAME = ? AND TABLE_SCHEMA = DATABASE()",
            [$table, $column]
        );

        return $result[0]->DATA_TYPE ?? '';
    }
};
