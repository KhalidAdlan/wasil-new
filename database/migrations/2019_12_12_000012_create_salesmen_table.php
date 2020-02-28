<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesmenTable extends Migration
{
    public function up()
    {
        Schema::create('salesmen', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('username');

            $table->string('password');

            $table->decimal('commission', 15, 2)->nullable();


            $table->string('phone')->nullable();

            $table->string('address')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
