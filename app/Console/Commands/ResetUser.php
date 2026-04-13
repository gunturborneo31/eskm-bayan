<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset
                            {email : Email pengguna}
                            {password : Password baru}
                            {--name= : Nama pengguna}
                            {--role=admin : Role pengguna}
                            {--username= : Username pengguna}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset atau buat user baru dengan email dan password';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->option('name') ?: 'User ' . explode('@', $email)[0];
        $role = $this->option('role') ?? 'admin';
        $username = $this->option('username') ?: $email;

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([
                'name' => $name,
                'username' => $username,
                'password' => Hash::make($password),
                'keterangan' => $role,
            ]);
            $this->info("✓ User diperbarui:");
        } else {
            User::create([
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($password),
                'keterangan' => $role,
            ]);
            $this->info("✓ User baru dibuat:");
        }

        $this->line("  Email: {$email}");
        $this->line("  Username: {$username}");
        $this->line("  Password: {$password}");
        $this->line("  Role: {$role}");

        return 0;
    }
}
