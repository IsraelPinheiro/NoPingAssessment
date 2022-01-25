<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table((new Supplier())->getTable())->truncate();
        Supplier::create([
			'name' => 'Microsoft Corporation',
			'email' => 'xbox@microsoft.com'
        ]);
        Supplier::create([
			'name' => 'Sony Interactive Entertainment',
			'email' => 'play@sie.com'
        ]);
        Supplier::create([
			'name' => 'Nintendo Co., Ltd.',
			'email' => 'games@nintendo.com'
        ]);
        Supplier::create([
			'name' => 'Intel Corporation',
			'email' => 'info@intel.com'
        ]);
        $this->command->info('Suppliers Created');
    }
}
