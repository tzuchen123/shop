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
        DB::table('product_types')->truncate();

        DB::table('product_types')->insert([
            'typename'=>'woman',
        ]);

        DB::table('product_types')->insert([
            'typename'=>'man',
        ]);

        DB::table('product_types')->insert([
            'typename'=>'kid',
        ]);

        DB::table('product_types')->insert([
            'typename'=>'accessories',
        ]);
        
        $type = factory(ProductType::class,20)->create();

    }
}
