<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Drugs;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add all the drugs to the database  

        $categories = [];

        $drugs = [
            [
                "name" => "Amlodipine",
                "category_id" => 1,
                "description" => ""
            ],
            [
                "name" => "Warfarin",
                "category_id" => 1,
                "description" => "Anticoagulant (blood thinner) to prevent blood clots."
            ],
            [
                "name" => "Enalapril",
                "category_id" => 1,
                "description" => ""
            ],
            [
                "name" => "Losartan",
                "category_id" => 1,
                "description" => ""
            ],
            [
                "name" => "Hydrochlorothiazide",
                "category_id" => 1,
                "description" => "Diuretic used to treat hypertension and edema."
            ],
            [
                "name" => "Metoprolol",
                "category_id" => 1,
                "description" => "Beta-blocker used for hypertension and heart conditions."
            ],
            [
                "name" => "Lisinopril",
                "category_id" => 1,
                "description" => "Angiotensin-converting enzyme (ACE) inhibitor for hypertension."
            ],
            [
                "name" => "Metformin",
                "category_id" => 2,
                "description" => "Oral antidiabetic medication for type 2 diabetes."
            ],
            [
                "name" => "Insulin",
                "category_id" => 2,
                "description" => ""
            ],
            [
                "name" => "Levothyroxine",
                "category_id" => 2,
                "description" => "Thyroid hormone replacement for hypothyroidism."
            ],
            [
                "name" => "Glipizide",
                "category_id" => 2,
                "description" => ""
            ],
            [
                "name" => "Sitagliptin",
                "category_id" => 2,
                "description" => ""
            ],
            [
                "name" => "Liraglutide",
                "category_id" => 2,
                "description" => ""
            ],
            [
                "name" => "Atorvastatin",
                "category_id" => 3,
                "description" => "Statin medication used to lower cholesterol."
            ],
            [
                "name" => "Clopidogrel",
                "category_id" => 3,
                "description" => "Antiplatelet agent to prevent blood clots."
            ],
            [
                "name" => "Amoxicillin",
                "category_id" => 3,
                "description" => "Antibiotic used to treat bacterial infections."
            ],
            [
                "name" => "Simvastatin",
                "category_id" => 3,
                "description" => "Statin medication for lowering cholesterol."
            ],
            [
                "name" => "Furosemide",
                "category_id" => 3,
                "description" => "Loop diuretic used for edema and hypertension."
            ],
            [
                "name" => "Rosuvastatin",
                "category_id" => 3,
                "description" => ""
            ],
            [
                "name" => "Ezetimibe",
                "category_id" => 3,
                "description" => ""
            ],
            [
                "name" => "Fenofibrate",
                "category_id" => 3,
                "description" => ""
            ],
            [
                "name" => "Albuterol",
                "category_id" => 4,
                "description" => "Short-acting bronchodilator used for asthma and COPD."
            ],
            [
                "name" => "Fluticasone/Salmeterol",
                "category_id" => 4,
                "description" => ""
            ],
            [
                "name" => "Prednisone",
                "category_id" => 4,
                "description" => "Corticosteroid with anti-inflammatory properties."
            ],
            [
                "name" => "Escitalopram",
                "category_id" => 4,
                "description" => "Selective serotonin reuptake inhibitor (SSRI) for depression and anxiety."
            ],
            [
                "name" => "Sertraline",
                "category_id" => 4,
                "description" => "SSRI used for depression, anxiety, and other mood disorders."
            ],
            [
                "name" => "Montelukast",
                "category_id" => 4,
                "description" => ""
            ],
            [
                "name" => "Budesonide",
                "category_id" => 4,
                "description" => ""
            ],
            [
                "name" => "Formoterol",
                "category_id" => 4,
                "description" => ""
            ],
            [
                "name" => "Methotrexate",
                "category_id" => 5,
                "description" => ""
            ],
            [
                "name" => "Omeprazole",
                "category_id" => 5,
                "description" => "Proton pump inhibitor (PPI) for acid reflux and peptic ulcers."
            ],
            [
                "name" => "Adalimumab",
                "category_id" => 5,
                "description" => ""
            ],
            [
                "name" => "Etanercept",
                "category_id" => 5,
                "description" => ""
            ],
            [
                "name" => "Infliximab",
                "category_id" => 5,
                "description" => ""
            ],
            [
                "name" => "Tocilizumab",
                "category_id" => 5,
                "description" => ""
            ],
            [
                "name" => "Acetaminophen (Paracetamol)",
                "category_id" => 6,
                "description" => "Pain reliever and fever reducer"
            ],
            [
                "name" => "Ibuprofen",
                "category_id" => 6,
                "description" => "Nonsteroidal anti-inflammatory drug (NSAID) used for pain and inflammation."
            ],
            [
                "name" => "Aspirin",
                "category_id" => 6,
                "description" => "NSAID used for pain relief and as an antiplatelet agent."
            ],
            [
                "name" => "Diazepam",
                "category_id" => 6,
                "description" => "Benzodiazepine used for anxiety and muscle spasms."
            ]
            
        ];
        
        foreach($drugs as $drug){
            Drugs::create([
                'name' => $drug['name'], 
                'category_id' => $drug['category_id'],
                'description' => $drug['description']
            ]);
        }
    }
}
