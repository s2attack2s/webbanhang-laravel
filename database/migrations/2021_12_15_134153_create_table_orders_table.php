<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id', 255);
            $table->string('product_id', 255);
            $table->string('price', 255);
            $table->string('quantity', 255);
            $table->string('total', 255);
            $table->string('status', 255);//0 là đanng chờ xác nhận, 1 là đang giao, 2 là hủy 3 là giao thành công
            $table->timestamps();
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
