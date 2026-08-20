<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\MerchUser;

class MerchUserSeeder extends Seeder
{
    public function run(): void
    {
        MerchUser::firstOrCreate([
            'username' => 'merch1'
        ],[
            'password' => Hash::make('merchpass'),
            'name' => 'Merch Team 1'
        ]);
    }
}
