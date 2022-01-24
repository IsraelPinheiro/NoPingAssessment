<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('products', function (Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->string('sku')->unique();
            $table->text('description')->nullable()->default(null);
            $table->integer('in_stock')->unsigned()->default(0);
            $table->bigInteger('supplier_id')->unsigned();
            $table->decimal('price', 8, 2)->unsigned()->default(0);
            $table->timestamps();   //created_at and updated_at
            $table->softDeletes();  //deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('products');
    }
}
