<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('stock_date');
            $table->unsignedBigInteger('product_type_id_fk');
            $table->unsignedBigInteger('vendor_id_fk');
            $table->unsignedBigInteger('brand_id_fk');
            $table->float('unit_price');
            $table->integer('unit_quantity');
            $table->unsignedBigInteger('status_id')->default(2);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('status_id')->references('id')->on('dictionaries')->onDelete('cascade');
            $table->foreign('product_type_id_fk')->references('id')->on('product_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
