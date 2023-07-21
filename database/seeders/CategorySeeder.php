<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['number' => 1, 'name' => "Aritmética básica", 'number', 'level' => 0],
            ['number' => 2, 'name' => "Problemas de proporciones", 'level' => 1],
            ['number' => 3, 'name' => "Geometría básica", 'level' => 2],
            ['number' => 4, 'name' => "Problemas de porcentajes", 'level' => 3],
            ['number' => 5, 'name' => "Problemas de tiempo y velocidad", 'level' => 3],

        ];

        $level = [
            "bajo", "medio", "medio-alto", "alto"
        ];

        
        
        DB::transaction(function () use ($categories, $level) {
            foreach ($categories  as $category) {
                Category::updateOrCreate(
                    [
                        'name'              => $category['name'],
                        'category_number'   => $category['number'],
                    ],
                    [
                        'level'             => $level[$category['level']]
                    ]
                );
            }
        });
    }
}
