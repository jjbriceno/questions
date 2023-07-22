<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Question;
use App\Models\Category;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionary = base_path("database/seeders/data/questionay.csv");

        if (!file_exists($questionary) || !is_readable($questionary)) {
            return false;
        }

        $csv_questionary = fopen($questionary, "r");

        DB::transaction(function () use ($csv_questionary) {
            while (($data = fgetcsv($csv_questionary, 0, ";")) !== false) {
                $category__id   = intval(trim($data[0], " "));
                $question       = trim($data[1], " ");
                $option_1       = trim($data[2], " ");
                $option_2       = trim($data[3], " ");
                $option_3       = trim($data[4], " ");
                $option_4       = trim($data[5], " ");
                $unit           = trim($data[6], " ");
                $answer         = trim($data[7], " ");
                
                $category_id = Category::find($category__id)->id;
                if($category_id){
                    Question::updateOrCreate(
                        [
                            'answer'            => $answer.' '.$unit,
                        ],
                        [
                            'category_id'       => $category_id,
                            'question_name'     => $question,
                            'answers_options'   => json_encode([
                                $option_1.' '.$unit, 
                                $option_2.' '.$unit, 
                                $option_3.' '.$unit, 
                                $option_4.' '.$unit
                            ]),
                        ]
                    );   
                }
            }
        });
    }
}
