<?php

use App\ProductType;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('product_types')->insert([
        //     'typename'=>'123',
        // ]);
        $type = factory(ProductType::class,20)->create();

    }
}
