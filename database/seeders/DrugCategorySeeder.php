<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DrugCategory;

class DrugCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add all the drug categories 

        $categories = [ 
            ["name" => "Hypertension", "description" => "High Blood Pressure"], 
            ["name" => "Diabetes Mellitus", "description" => null],
            ["name" => "Hyperlipidemia", "description" => "High Cholesterol"],
            ["name" => "Asthma","description" => null ], 
            ["name" => "Rheumatoid Arthritis", "description" => null],
            ["name" => "Pain Reliever", "description" => null],
            ["name" => "Thyroid Disorders", "description" => null],
        ];
        
        foreach($categories as $category){
            DrugCategory::create(['name' => $category['name'], 'description' => $category['description']]);
        }
    }
}
