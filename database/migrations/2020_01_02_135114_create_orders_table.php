<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no');
            $table->string('receive_name');
            $table->string('receive_mobile');
            $table->string('receive_address');
            $table->string('receive_email');
            $table->string('receipt');
            $table->string('time_to_send');
            $table->string('status')->default('new_order');
            $table->integer('total_price');
            $table->string('remark', '2000');
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
        Schema::dropIfExists('orders');
    }
}
