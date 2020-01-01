<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('customer_id')->nullable();

            $table->foreign('customer_id', 'customer_fk_723313')->references('id')->on('customers');

            $table->unsignedInteger('product_id')->nullable();

            $table->foreign('product_id', 'product_fk_723314')->references('id')->on('products');

            $table->unsignedInteger('salesmen_id')->nullable();

            $table->foreign('salesmen_id', 'salesmen_fk_723315')->references('id')->on('salesmen');
        });
    }
}
