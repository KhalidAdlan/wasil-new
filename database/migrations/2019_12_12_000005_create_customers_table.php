<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('area');

            $table->string('phone2')->nullable();

            $table->string('address')->nullable();

            $table->string('phone');

            $table->string('state')->nullable();

            $table->string('email')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
