<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testproducts = 25;
        $testdag = 27;
        $testweek = 32;
        for ($i = 1; $i < $testproducts; $i++) {
            DB::table('products')->insert([
                'name' => 'Product'.$i,
                'description' => 'Beschrijving voor Product'.$i,
                'image' => 'https://via.placeholder.com/640x480.png/003344?text=Product'.$i,
                'price' => $i * 10,
                'suppliers_price' => $i * 10,
                'stock' => $i * 10,
                'EAN' => 100 .$i,
                'SKU' => 'A00000000000000'.$i,
                'last_edited_by' => 1,
                'percentage_aanbieding' => 0,
                'dag_aanbieding' => false,
                'week_aanbieding' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if ($i < 10) {
                DB::table('category_product')->insert([
                    'product_id' => $i,
                    'category_id' => 1,
                ]);
            } elseif ($i < 25) {
                DB::table('category_product')->insert([
                    'product_id' => $i,
                    'category_id' => 2,
                ]);
            }
        }
        for ($i = 25; $i < $testdag; $i++) {
            DB::table('products')->insert([
                'name' => 'Product'.$i,
                'description' => 'Beschrijving voor Product'.$i,
                'image' => 'https://via.placeholder.com/640x480.png/003344?text=Product'.$i,
                'price' => $i * 10,
                'suppliers_price' => $i * 10,
                'stock' => $i * 10,
                'EAN' => 100 .$i,
                'SKU' => 'A00000000000000'.$i,
                'last_edited_by' => 1,
                'percentage_aanbieding' => 25,
                'dag_aanbieding' => true,
                'week_aanbieding' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if ($i < 27) {
                DB::table('category_product')->insert([
                    'product_id' => $i,
                    'category_id' => 3,
                ]);
            }
        }
        for ($i = 27; $i < $testweek; $i++) {
            DB::table('products')->insert([
                'name' => 'Product'.$i,
                'description' => 'Beschrijving voor Product'.$i,
                'image' => 'https://via.placeholder.com/640x480.png/003344?text=Product'.$i,
                'price' => $i * 10,
                'suppliers_price' => $i * 10,
                'stock' => $i * 10,
                'EAN' => 100 .$i,
                'SKU' => 'A00000000000000'.$i,
                'last_edited_by' => 1,
                'percentage_aanbieding' => 50,
                'dag_aanbieding' => false,
                'week_aanbieding' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if ($i < 32) {
                DB::table('category_product')->insert([
                    'product_id' => $i,
                    'category_id' => 3,
                ]);
            }
        }
    }
}
