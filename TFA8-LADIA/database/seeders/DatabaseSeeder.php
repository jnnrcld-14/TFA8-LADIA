<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Customer::query()->insert([
            ['full_name' => 'Alex Morgan', 'email' => 'alex.morgan@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['full_name' => 'Jamie Cruz', 'email' => 'jamie.cruz@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['full_name' => 'Taylor Reyes', 'email' => 'taylor.reyes@example.com', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Demo logins - the password is hashed automatically by the model cast.
        // Change or delete these accounts before deploying anywhere real.
        User::create([
            'username' => 'admin',
            'full_name' => 'POS Administrator',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        User::create([
            'username' => 'cashier01',
            'full_name' => 'Sample Cashier',
            'email' => 'cashier@example.com',
            'password' => 'password',
        ]);
    }
}
