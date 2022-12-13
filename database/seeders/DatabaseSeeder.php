<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        for ($i = 1; $i < 10; $i++) {
            // DB::table('categories')->insert([
            //     'name' => Str::random(10),
            //     'slug' => Str::random(10),
            //     'description' => Str::random(10),
            //     'status' => '1',
            //     'popular' => '1',
            //     'image' => '1.jpg',
            //     'meta_title' => Str::random(10),
            //     'meta_descrip' => Str::random(10),
            //     'meta_keywords' => Str::random(10),

            // ]);
            // DB::table('products')->insert([
            //     'cate_id'=>'1',
            //     'name'=> Str::random(10),
            //     'slug'=> Str::random(10),
            //     'small_description'=> Str::random(10),
            //     'description'=> Str::random(10),
            //     'original_price'=>'312312213',
            //     'selling_price'=>'89089890',
            //     'image'=> Str::random(10),
            //     'qty'=>'999',
            //     'tax'=>'1',
            //     'status'=>'1'
            // ]);
            DB::table('product_types')->insert([
                'prod_id'=>$i,
                'hot'=>'1',
                'best_selling'=>'1',
                'new'=>'1'
            ]);
        }
    }
}
