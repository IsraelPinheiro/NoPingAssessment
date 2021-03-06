<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table((new User())->getTable())->truncate();
        User::create([
			'name' => 'Administrator',
			'email' => 'admin@testmail.com',
            'password' => Hash::make('admin')
        ]);
        User::create([
			'name' => 'User',
			'email' => 'user@testmail.com',
            'password' => Hash::make('user')
        ]);
        $this->command->info('Users Created');
    }
}
