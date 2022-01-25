<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table((new Customer())->getTable())->truncate();
        Customer::create([
			'name' => 'Israel Reis Pinheiro',
			'email' => 'israel.pinheiro@live.com',
			'phone' => '85991520250',
			'birthday' => '1990-08-15',
			'last_purchase' => null
        ]);
        Customer::create([
			'name' => 'William Henry Gates III',
			'email' => 'bill.gates@gatesfoundation.com',
			'phone' => '11904041975',
			'birthday' => '1955-10-05',
			'last_purchase' => null
        ]);
        Customer::create([
			'name' => 'Jeffrey Preston Bezos',
			'email' => 'jeff@amazon.com',
			'phone' => '92905071994',
			'birthday' => '1964-01-15',
			'last_purchase' => null
        ]);
        Customer::create([
			'name' => 'Reginald Fils-Aimé',
			'email' => 'reggie@nintendo.com',
			'phone' => '11923091889',
			'birthday' => '1961-03-25',
			'last_purchase' => null
        ]);
        Customer::create([
			'name' => 'Phil Spencer',
			'email' => 'p3@microsoft.com',
			'phone' => '85915112001',
			'birthday' => '1968-01-12',
			'last_purchase' => null
        ]);
        $this->command->info('Customers Created');
    }
}
