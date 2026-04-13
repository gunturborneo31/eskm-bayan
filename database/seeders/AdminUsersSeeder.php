<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeds a single superadmin account for the admin dashboard.
 *
 * The `username` and `keterangan` columns are added by migration
 * 2026_04_09_000003_add_username_keterangan_to_users_table.php.
 */
class AdminUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus user lama dan buat admin baru
        User::query()->delete();

        User::create([
            'name'       => 'Admin SKM',
            'username'   => 'admin@eskmbayan.com',
            'email'      => 'admin@eskmbayan.com',
            'keterangan' => 'admin',
            'password'   => Hash::make('password123'),
        ]);

        $this->command->info('✓ User admin baru berhasil dibuat');
        $this->command->info('  Email: admin@eskmbayan.com');
        $this->command->info('  Username: admin@eskmbayan.com');
        $this->command->info('  Password: password123');
        $this->command->info('  Role: admin');
    }
}
