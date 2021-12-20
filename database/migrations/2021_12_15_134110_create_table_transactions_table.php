<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 255);
            $table->string('name', 255);
            $table->string('phone', 255);
            $table->string('total', 255);
            $table->string('quantity', 255);
            $table->string('address', 255);
            $table->text('message')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
