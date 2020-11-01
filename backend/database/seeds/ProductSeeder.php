<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Product::class, 30)->create();
        DB::table('products')->insert([
            'name' => 'Wooden Pencil',
            'inStock' => true,
            'created_at' => now()
        ]);

        DB::table('products')->insert([
            'name' => 'Wooden Pencil #2 Medium Lead',
            'inStock' => true,
            'created_at' => now()
        ]);

        DB::table('products')->insert([
            'name' => 'Xtra-Life Mechanical Pencils, No. 2 Medium Lead',
            'inStock' => true,
            'created_at' => now()
        ]);

        DB::table('products')->insert([
            'name' => 'Pentel Twist-Erase Express Mechanical Pencils',
            'inStock' => true,
            'created_at' => now()
        ]);

        DB::table('products')->insert([
            'name' => 'Staples Mechanical Pencils, No. 2 Medium Lead',
            'inStock' => true,
            'created_at' => now()
        ]);

        DB::table('products')->insert([
            'name' => 'Staples 0.75" Binder Clips, Small, Assorted Colors',
            'inStock' => true,
            'created_at' => now()
        ]);

        DB::table('products')->insert([
            'name' => 'Staples Gummed #6 Business Envelopes',
            'inStock' => true,
            'created_at' => now()
        ]);
    }
}
