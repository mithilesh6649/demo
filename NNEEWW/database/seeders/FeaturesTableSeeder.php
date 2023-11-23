<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('features')->delete();
        
        \DB::table('features')->insert(array (
            0 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 1,
                'is_genetic_test' => 0,
                'name' => 'Genetic Testing',
                'other_test_count' => NULL,
                'slug' => 'app',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:45:47',
            ),
            1 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 2,
                'is_genetic_test' => 0,
                'name' => 'Genetic Reports',
                'other_test_count' => NULL,
                'slug' => 'bmi_tracking',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:45:57',
            ),
            2 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 3,
                'is_genetic_test' => 0,
                'name' => 'Precision Diet Plans',
                'other_test_count' => NULL,
                'slug' => 'weight_tracking',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:46:13',
            ),
            3 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 4,
                'is_genetic_test' => 0,
                'name' => 'Precision Medicine',
                'other_test_count' => NULL,
                'slug' => 'macronutrient_tracking',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:45:11',
            ),
            4 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 5,
                'is_genetic_test' => 0,
                'name' => 'Precision Supplementation',
                'other_test_count' => NULL,
                'slug' => 'recipes',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:45:30',
            ),
            5 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 6,
                'is_genetic_test' => 0,
                'name' => 'App Basic Features',
                'other_test_count' => NULL,
                'slug' => 'upload_biochemical_tests',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:48:29',
            ),
            6 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 7,
                'is_genetic_test' => 0,
                'name' => 'BMI Tracking',
                'other_test_count' => NULL,
                'slug' => 'clinical_data_registry',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:48:52',
            ),
            7 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 8,
                'is_genetic_test' => 0,
                'name' => 'Basic Diet Plans',
                'other_test_count' => NULL,
                'slug' => 'graphical_progress',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:49:32',
            ),
            8 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 9,
                'is_genetic_test' => 0,
                'name' => 'Recipes',
                'other_test_count' => NULL,
                'slug' => 'genomic_tests',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:50:02',
            ),
            9 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 10,
                'is_genetic_test' => 0,
                'name' => 'Macronutrient Tracking',
                'other_test_count' => NULL,
                'slug' => 'personalized_diet_plans',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:50:47',
            ),
            10 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 11,
                'is_genetic_test' => 0,
                'name' => 'Micronutrient Tracking',
                'other_test_count' => NULL,
                'slug' => 'diet_plans_for_chronic_diseases',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:50:59',
            ),
            11 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 12,
                'is_genetic_test' => 0,
                'name' => 'App Premium Features',
                'other_test_count' => NULL,
                'slug' => 'fitness_guide',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:51:33',
            ),
            12 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 13,
                'is_genetic_test' => 0,
                'name' => 'Upload Biochemical Tests',
                'other_test_count' => NULL,
                'slug' => 'keto_meal_plan',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:52:07',
            ),
            13 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 14,
                'is_genetic_test' => 0,
                'name' => 'Clinical Data Registry',
                'other_test_count' => NULL,
                'slug' => 'intermittent_fasting_meal_plan',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:52:45',
            ),
            14 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 15,
                'is_genetic_test' => 0,
                'name' => 'Track Anthropometric Data',
                'other_test_count' => NULL,
                'slug' => 'detox_meal_plan',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:54:03',
            ),
            15 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 16,
                'is_genetic_test' => 0,
                'name' => 'Graphical Progress',
                'other_test_count' => NULL,
                'slug' => 'immune_booster_diet_plan',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:54:27',
            ),
            16 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 17,
                'is_genetic_test' => 0,
                'name' => 'Diet Plans for Chronic Diseases',
                'other_test_count' => NULL,
                'slug' => 'doctor_consultation',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:55:24',
            ),
            17 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 18,
                'is_genetic_test' => 0,
                'name' => 'Fitness Plan',
                'other_test_count' => NULL,
                'slug' => 'scientist_consultations',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:56:24',
            ),
            18 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 19,
                'is_genetic_test' => 0,
                'name' => 'Lifestyle Modification Plan',
                'other_test_count' => NULL,
                'slug' => 'clinical_nutritionist_consultations',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:56:43',
            ),
            19 => 
            array (
                'created_at' => '2023-02-07 06:32:19',
                'deleted_at' => '2023-02-07 06:32:19',
                'genetic_test_count' => NULL,
                'id' => 20,
                'is_genetic_test' => 0,
                'name' => 'Doctor Consultation',
                'other_test_count' => NULL,
                'slug' => 'partner_lab',
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:57:18',
            ),
            20 => 
            array (
                'created_at' => '2023-04-10 20:57:45',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 21,
                'is_genetic_test' => 0,
                'name' => 'Scientist Consultations',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:58:03',
            ),
            21 => 
            array (
                'created_at' => '2023-04-10 20:58:19',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 22,
                'is_genetic_test' => 0,
                'name' => 'Clinical Nutritionist consultations',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:58:19',
            ),
            22 => 
            array (
                'created_at' => '2023-04-10 20:58:49',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 23,
                'is_genetic_test' => 0,
                'name' => 'Partner Labs',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:58:49',
            ),
            23 => 
            array (
                'created_at' => '2023-04-10 20:59:25',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 24,
                'is_genetic_test' => 0,
                'name' => 'Short-term Specialized Diet Plans',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 1,
                'updated_at' => '2023-04-10 20:59:25',
            ),
            24 => 
            array (
                'created_at' => '2023-05-17 11:12:59',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 25,
                'is_genetic_test' => 0,
                'name' => '1+1  genetic tests',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:13:42',
            ),
            25 => 
            array (
                'created_at' => '2023-05-17 11:13:26',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 26,
                'is_genetic_test' => 0,
                'name' => '3+2  genetic tests',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:13:51',
            ),
            26 => 
            array (
                'created_at' => '2023-05-17 11:14:20',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 27,
                'is_genetic_test' => 0,
                'name' => '6+3  customized genetic tests',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:14:36',
            ),
            27 => 
            array (
                'created_at' => '2023-05-17 11:15:49',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 28,
                'is_genetic_test' => 0,
            'name' => '1 free  Nutrigenomics ( Diet and Nutrition ) test',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:15:49',
            ),
            28 => 
            array (
                'created_at' => '2023-05-17 11:16:30',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 29,
                'is_genetic_test' => 0,
                'name' => '1 free DNA  fitness test',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:16:30',
            ),
            29 => 
            array (
                'created_at' => '2023-05-17 11:17:01',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 30,
                'is_genetic_test' => 0,
                'name' => 'Metabolic tests',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:17:01',
            ),
            30 => 
            array (
                'created_at' => '2023-05-17 11:17:22',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 31,
                'is_genetic_test' => 0,
                'name' => 'Dedicated clinical nutrition coach',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:17:22',
            ),
            31 => 
            array (
                'created_at' => '2023-05-17 11:18:01',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 32,
                'is_genetic_test' => 0,
                'name' => 'Precision Diet Plans',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:18:01',
            ),
            32 => 
            array (
                'created_at' => '2023-05-17 11:18:49',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 33,
                'is_genetic_test' => 0,
                'name' => 'Weekly  Consultations',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:18:49',
            ),
            33 => 
            array (
                'created_at' => '2023-05-17 11:19:18',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 34,
                'is_genetic_test' => 0,
                'name' => 'Unlimited  Consultations',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:19:26',
            ),
            34 => 
            array (
                'created_at' => '2023-05-17 11:21:12',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 35,
                'is_genetic_test' => 0,
                'name' => '1 Genetic consultation with German Scientists',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:21:12',
            ),
            35 => 
            array (
                'created_at' => '2023-05-17 11:21:25',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 36,
                'is_genetic_test' => 0,
                'name' => '2 Genetic consultation with German Scientists',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:21:25',
            ),
            36 => 
            array (
                'created_at' => '2023-05-17 11:21:41',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 37,
                'is_genetic_test' => 0,
                'name' => 'Dedicated chat support',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:21:41',
            ),
            37 => 
            array (
                'created_at' => '2023-05-17 11:22:48',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 38,
                'is_genetic_test' => 0,
                'name' => '1 free genetic consultation on physical exercise that suits you',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-17 11:22:48',
            ),
            38 => 
            array (
                'created_at' => '2023-05-17 12:12:52',
                'deleted_at' => NULL,
                'genetic_test_count' => 1,
                'id' => 39,
                'is_genetic_test' => 1,
                'name' => '<ul>
<li><strong>Choose 1 test from</strong></li>
<li>Obesity</li>
<li>Diabetes</li>
<li>Heart Disorders</li>
<li>Renal Disorders</li>
<li>Women&#39;s health (PCOS)</li>
<li>Skin and&nbsp;Hair</li>
<li><strong>1 Free Nutrigenomics ( Diet and Nutrition ) test</strong></li>
</ul>

<p>&nbsp;</p>',
                'other_test_count' => 1,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:28:16',
            ),
            39 => 
            array (
                'created_at' => '2023-05-17 12:20:24',
                'deleted_at' => NULL,
                'genetic_test_count' => 3,
                'id' => 40,
                'is_genetic_test' => 1,
                'name' => '<ul>
<li><strong>Choose 3&nbsp;tests from</strong></li>
<li>Obesity</li>
<li>Diabetes</li>
<li>Heart Disorders</li>
<li>Renal Disorders</li>
<li>Women&#39;s health (PCOS)</li>
<li>Skin and&nbsp;Hair</li>
<li><strong>1 Free Nutrigenomics ( Diet and Nutrition ) test</strong></li>
<li><strong>1 Free DNA fitness test fitness ( what exercise suits your DNA )</strong></li>
</ul>

<p>&nbsp;</p>',
                'other_test_count' => 2,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:28:35',
            ),
            40 => 
            array (
                'created_at' => '2023-05-17 12:21:18',
                'deleted_at' => NULL,
                'genetic_test_count' => 2,
                'id' => 41,
                'is_genetic_test' => 1,
                'name' => '<ul>
<li><strong>Choose 2&nbsp;tests from</strong></li>
<li>Obesity</li>
<li>Diabetes</li>
<li>Heart Disorders</li>
<li>Renal Disorders</li>
<li>Women&#39;s health (PCOS)</li>
<li>Skin and&nbsp;Hair</li>
<li><strong>1 Free Nutrigenomics ( Diet and Nutrition ) test</strong></li>
</ul>

<p>&nbsp;</p>',
                'other_test_count' => 1,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:28:55',
            ),
            41 => 
            array (
                'created_at' => '2023-05-17 12:32:55',
                'deleted_at' => NULL,
                'genetic_test_count' => 3,
                'id' => 42,
                'is_genetic_test' => 1,
                'name' => '<ul>
<li><strong>Choose all 6&nbsp;tests from</strong></li>
<li>Obesity</li>
<li>Diabetes</li>
<li>Heart Disorders</li>
<li>Renal Disorders</li>
<li>Women&#39;s health (PCOS)</li>
<li>Skin and&nbsp;Hair</li>
<li><strong>1 Free Nutrigenomics ( Diet and Nutrition ) test</strong></li>
<li><strong>1 Free DNA fitness test fitness ( what exercise suits your DNA )</strong></li>
<li><strong>1 Free Pharmacogenomics test ( right medicine&nbsp; that suits you )</strong></li>
</ul>

<p>&nbsp;</p>',
                'other_test_count' => 3,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:32:55',
            ),
            42 => 
            array (
                'created_at' => '2023-05-17 12:35:53',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 43,
                'is_genetic_test' => 0,
            'name' => '3 Metabolic Tests ( 80+ Parameter blood  and urine tests )',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:35:53',
            ),
            43 => 
            array (
                'created_at' => '2023-05-17 12:36:42',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 44,
                'is_genetic_test' => 0,
            'name' => '1 Metabolic Tests ( Smart Panel )',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:36:42',
            ),
            44 => 
            array (
                'created_at' => '2023-05-17 12:37:37',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 45,
                'is_genetic_test' => 0,
                'name' => 'Metabolic tests analysis only',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:37:37',
            ),
            45 => 
            array (
                'created_at' => '2023-05-17 12:38:11',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 46,
                'is_genetic_test' => 0,
            'name' => '1 Metabolic Tests ( 80+ Parameter blood  and urine tests )',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:38:11',
            ),
            46 => 
            array (
                'created_at' => '2023-05-17 12:41:21',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 47,
                'is_genetic_test' => 0,
                'name' => 'Personal clinical nutrition coach',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:41:21',
            ),
            47 => 
            array (
                'created_at' => '2023-05-17 12:42:16',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 48,
                'is_genetic_test' => 0,
                'name' => '12 months Precision Diet Plans',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:42:16',
            ),
            48 => 
            array (
                'created_at' => '2023-05-17 12:42:41',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 49,
                'is_genetic_test' => 0,
                'name' => '6 months Precision Diet Plans',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:42:41',
            ),
            49 => 
            array (
                'created_at' => '2023-05-17 12:42:49',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 50,
                'is_genetic_test' => 0,
                'name' => '2 months Precision Diet Plans',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:42:49',
            ),
            50 => 
            array (
                'created_at' => '2023-05-17 12:47:59',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 51,
                'is_genetic_test' => 0,
                'name' => '6 months Presonalized Diet Plans',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:47:59',
            ),
            51 => 
            array (
                'created_at' => '2023-05-17 12:48:08',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 52,
                'is_genetic_test' => 0,
                'name' => '1 months Presonalized Diet Plans',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 3,
                'updated_at' => '2023-05-17 12:48:08',
            ),
            52 => 
            array (
                'created_at' => '2023-05-18 05:48:07',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 53,
                'is_genetic_test' => 0,
                'name' => '2+1   genetic test',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-18 05:48:07',
            ),
            53 => 
            array (
                'created_at' => '2023-05-18 05:49:50',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 54,
                'is_genetic_test' => 0,
            'name' => '1 Free Pharmacogenomics test ( right medicine & dose  for you )',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-18 05:49:50',
            ),
            54 => 
            array (
                'created_at' => '2023-05-18 05:56:27',
                'deleted_at' => NULL,
                'genetic_test_count' => NULL,
                'id' => 55,
                'is_genetic_test' => 0,
                'name' => '3+3 customized genetic tests',
                'other_test_count' => NULL,
                'slug' => NULL,
                'status' => 1,
                'type' => 2,
                'updated_at' => '2023-05-18 05:56:27',
            ),
        ));
        
        
    }
}