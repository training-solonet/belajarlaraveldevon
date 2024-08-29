<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Category::factory(3)->create(),
        Category::create([
            'name'=>'PPLG',
            'Slug'=>'rpl'
        ]);

        Category::create([
            'name'=>'TJKT',
            'Slug'=>'tkj'
        ]);

        Category::create([
            'name'=>'TKRO',
            'Slug'=>'to'
        ]);

        Category::create([
            'name'=>'TPFL',
            'Slug'=>'tflm'
        ]);
    }
}
