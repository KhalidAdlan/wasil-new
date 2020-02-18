<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinesTable extends Migration
{
    public function up()
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->increments('id');

            $table->string('number');

            $table->integer('status')->default(0);

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
