<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->id();
            $table->integer('diary_no');
            $table->date('date');
            $table->unsignedBigInteger('branch_id_fk');
            $table->string('applicant_name');
            $table->string('forwarded_by');
            $table->string('received_by');
            $table->date('received_date');
            $table->string('approved_by');
            $table->date('approved_date');
            $table->unsignedBigInteger('product_id_fk');
            $table->unsignedBigInteger('brand_id_fk');
            $table->integer('stock_out_qty');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_outs');
    }
}
