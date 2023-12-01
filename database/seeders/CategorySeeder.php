<?php

namespace Database\Seeders;

use App\Models\Categories;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Category 1','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name' => 'Category 2','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name' => 'Category 3','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],

        ];
        Categories::query()->insert($categories);
    }
}
