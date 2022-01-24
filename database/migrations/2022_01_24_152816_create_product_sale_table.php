<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSaleTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('product_sale', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->decimal('sell_price', 8, 2)->unsigned()->default(0);
            $table->integer('sold_amount')->unsigned()->default(0);
            $table->bigInteger('sale_id')->unsigned();
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
        Schema::dropIfExists('product_sale');
    }
}
