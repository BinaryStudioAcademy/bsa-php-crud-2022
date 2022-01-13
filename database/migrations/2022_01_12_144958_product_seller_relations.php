<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductSellerRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_products', function (Blueprint $table) {
            $table->foreignId('seller_id')->nullable();
            $table->foreign('seller_id')
                ->references('id')
                ->on('sellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_products', function (Blueprint $table) {
            $table->dropForeign('my_products_seller_id_foreign');
            $table->dropColumn('seller_id');
        });
    }
}
