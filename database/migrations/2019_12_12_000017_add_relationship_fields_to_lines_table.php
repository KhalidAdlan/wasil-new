<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLinesTable extends Migration
{
    public function up()
    {
        Schema::table('lines', function (Blueprint $table) {
            $table->unsignedInteger('driver_id')->nullable();

            $table->foreign('driver_id', 'driver_fk_723312')->references('id')->on('drivers');
        });
    }
}
