<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'GadgetKita Admin',
            'email'    => 'admin@gadgetkita.com',
            'password' => Hash::make('rahasia123'),
        ]);
    }
}
