<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('invoice_number');

            $table->string('status');

            $table->string('type')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
