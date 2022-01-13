<?php

namespace Database\Seeders;

use Database\Factories\ProductFactory;
use Database\Factories\SellerFactory;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new SellerFactory(10))->create()
            ->each(function ($seller) {
                $seller->products()->saveMany(
                    (new ProductFactory(20))->make(['seller_id'=>null])
                );
            });
    }
}
