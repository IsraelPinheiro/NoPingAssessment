<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table((new Sale())->getTable())->truncate();
        DB::table('product_sale')->truncate();
        Sale::create([
			'customer_id' => '3',
			'created_at' => '2020-11-12 11:59:00'
        ]);
        DB::table('product_sale')->insert([
            'sale_id' => 1,
            'product_id' => 4,
            'sell_price' => 499.00,
            'units' => 100
        ]);
        DB::table('product_sale')->insert([
            'sale_id' => 1,
            'product_id' => 5,
            'sell_price' => 399.00,
            'units' => 100
        ]);

        $this->command->info('Sales Created');
    }
}
