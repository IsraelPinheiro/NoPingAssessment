<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customers', function (Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique()->nullable()->default(null);
            $table->string('phone',11)->unique()->nullable()->default(null);
            $table->date('birthday')->nullable()->default(null);
            $table->datetime('last_purchase')->nullable()->default(null);
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
        Schema::dropIfExists('customers');
    }
}
