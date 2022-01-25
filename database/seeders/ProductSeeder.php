<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table((new Product())->getTable())->truncate();
        Product::create([
			'name' => 'Xbox One S All-Digital',
			'sku' => '5438774',
			'description' => 'The Xbox One is powered by an AMD "Jaguar" Accelerated Processing Unit (APU) with two quad-core modules totaling eight x86-64 cores clocked at 1.75 GHz, and 8 GB of DDR3 RAM with a memory bandwidth of 68.3 GB/s',
			'in_stock' => 4,
			'supplier_id' => 1,
            'price' => 249.99
        ]);
        Product::create([
			'name' => 'Xbox Series S',
			'sku' => '6430277',
			'description' => 'The Xbox Series S is comparable in its hardware to the Xbox Series X, similar to how the Xbox One S relates to the Xbox One X, but has less processing power. While it runs the same CPU with slightly slower clock frequencies, it uses a slower GPU',
			'in_stock' => 3,
			'supplier_id' => 1,
            'price' => 299.00
        ]);
        Product::create([
			'name' => 'Xbox Series X',
			'sku' => '6428324',
			'description' => 'The Xbox Series X has higher end hardware and supports higher display resolutions (up to 8K resolution), along with higher frame rates and real-time ray tracing; it also has a high-speed solid-state drive to reduce loading times',
			'in_stock' => 2,
			'supplier_id' => 1,
            'price' => 499.00
        ]);
        Product::create([
			'name' => 'Playstation 5',
			'sku' => 'CFI-1000A01',
			'description' => 'The latest Sony PlayStation introduced in November 2020. Powered by an eight-core AMD Zen 2 CPU and custom AMD Radeon GPU, the PS5 is offered in two models: with and without a 4K Blu-ray drive. Supporting a 120Hz video refresh, the PS5 is considerably more powerful than the PS4 and PS4 Pro.',
			'in_stock' => 0,
			'supplier_id' => 2,
            'price' => 499.00
        ]);
        Product::create([
			'name' => 'Playstation 5 Digital',
			'sku' => 'CFI-1000B01',
			'description' => 'The latest Sony PlayStation introduced in November 2020. Powered by an eight-core AMD Zen 2 CPU and custom AMD Radeon GPU, the PS5 is offered in two models: with and without a 4K Blu-ray drive. Supporting a 120Hz video refresh, the PS5 is considerably more powerful than the PS4 and PS4 Pro.',
			'in_stock' => 0,
			'supplier_id' => 2,
            'price' => 399.00
        ]);
        $this->command->info('Products Created');
    }
}
