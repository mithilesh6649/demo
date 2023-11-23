<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TraitListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('trait_lists')->delete();
        
        \DB::table('trait_lists')->insert(array (
            0 => 
            array (
                'id' => 1,
                'trait_category_id' => 1,
                'title' => 'Ability to maintain weight loss',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:57',
                'updated_at' => '2023-04-07 09:03:57',
            ),
            1 => 
            array (
                'id' => 2,
                'trait_category_id' => 1,
                'title' => 'Antioxidant Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:57',
                'updated_at' => '2023-04-07 09:03:57',
            ),
            2 => 
            array (
                'id' => 3,
                'trait_category_id' => 1,
                'title' => 'Bitter Taste Perception',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:57',
                'updated_at' => '2023-04-07 09:03:57',
            ),
            3 => 
            array (
                'id' => 4,
                'trait_category_id' => 1,
                'title' => 'Caffeine Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:58',
                'updated_at' => '2023-04-07 09:03:58',
            ),
            4 => 
            array (
                'id' => 5,
                'trait_category_id' => 1,
                'title' => 'Calcium Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:58',
                'updated_at' => '2023-04-07 09:03:58',
            ),
            5 => 
            array (
                'id' => 6,
                'trait_category_id' => 1,
                'title' => 'Emotional Eating Dependance',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:58',
                'updated_at' => '2023-04-07 09:03:58',
            ),
            6 => 
            array (
                'id' => 7,
                'trait_category_id' => 1,
                'title' => 'Fatty Food Preference',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:59',
                'updated_at' => '2023-04-07 09:03:59',
            ),
            7 => 
            array (
                'id' => 8,
                'trait_category_id' => 1,
                'title' => 'Gluten Intolerance',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:59',
                'updated_at' => '2023-04-07 09:03:59',
            ),
            8 => 
            array (
                'id' => 9,
                'trait_category_id' => 1,
                'title' => 'Iron Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:59',
                'updated_at' => '2023-04-07 09:03:59',
            ),
            9 => 
            array (
                'id' => 10,
                'trait_category_id' => 1,
                'title' => 'Lactose Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:59',
                'updated_at' => '2023-04-07 09:03:59',
            ),
            10 => 
            array (
                'id' => 11,
                'trait_category_id' => 1,
                'title' => 'Magnesium Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:03:59',
                'updated_at' => '2023-04-07 09:03:59',
            ),
            11 => 
            array (
                'id' => 12,
                'trait_category_id' => 1,
                'title' => 'Phosphate Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:00',
                'updated_at' => '2023-04-07 09:04:00',
            ),
            12 => 
            array (
                'id' => 13,
                'trait_category_id' => 1,
                'title' => 'Response to Carbohydrates',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:00',
                'updated_at' => '2023-04-07 09:04:00',
            ),
            13 => 
            array (
                'id' => 14,
                'trait_category_id' => 1,
                'title' => 'Response to Fibre',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:00',
                'updated_at' => '2023-04-07 09:04:00',
            ),
            14 => 
            array (
                'id' => 15,
                'trait_category_id' => 1,
                'title' => 'Response to Monounsaturated Fats',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:00',
                'updated_at' => '2023-04-07 09:04:00',
            ),
            15 => 
            array (
                'id' => 16,
                'trait_category_id' => 1,
                'title' => 'Response to Polyunsaturated Fats',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:00',
                'updated_at' => '2023-04-07 09:04:00',
            ),
            16 => 
            array (
                'id' => 17,
                'trait_category_id' => 1,
                'title' => 'Response to Protein',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:01',
                'updated_at' => '2023-04-07 09:04:01',
            ),
            17 => 
            array (
                'id' => 18,
                'trait_category_id' => 1,
                'title' => 'Response to Saturated Fats',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:01',
                'updated_at' => '2023-04-07 09:04:01',
            ),
            18 => 
            array (
                'id' => 19,
                'trait_category_id' => 1,
                'title' => 'Salt Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:01',
                'updated_at' => '2023-04-07 09:04:01',
            ),
            19 => 
            array (
                'id' => 20,
                'trait_category_id' => 1,
                'title' => 'Satiety Response',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:01',
                'updated_at' => '2023-04-07 09:04:01',
            ),
            20 => 
            array (
                'id' => 21,
                'trait_category_id' => 1,
                'title' => 'Snacking Pattern',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:02',
                'updated_at' => '2023-04-07 09:04:02',
            ),
            21 => 
            array (
                'id' => 22,
                'trait_category_id' => 1,
                'title' => 'Sweet Taste Perception',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:02',
                'updated_at' => '2023-04-07 09:04:02',
            ),
            22 => 
            array (
                'id' => 23,
                'trait_category_id' => 1,
                'title' => 'Vitamin A Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:02',
                'updated_at' => '2023-04-07 09:04:02',
            ),
            23 => 
            array (
                'id' => 24,
                'trait_category_id' => 1,
                'title' => 'Vitamin B12 Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:02',
                'updated_at' => '2023-04-07 09:04:02',
            ),
            24 => 
            array (
                'id' => 25,
                'trait_category_id' => 1,
                'title' => 'Vitamin B6 Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:02',
                'updated_at' => '2023-04-07 09:04:02',
            ),
            25 => 
            array (
                'id' => 26,
                'trait_category_id' => 1,
                'title' => 'Vitamin B9 Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:03',
                'updated_at' => '2023-04-07 09:04:03',
            ),
            26 => 
            array (
                'id' => 27,
                'trait_category_id' => 1,
                'title' => 'Vitamin C Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:03',
                'updated_at' => '2023-04-07 09:04:03',
            ),
            27 => 
            array (
                'id' => 28,
                'trait_category_id' => 1,
                'title' => 'Vitamin D Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:03',
                'updated_at' => '2023-04-07 09:04:03',
            ),
            28 => 
            array (
                'id' => 29,
                'trait_category_id' => 1,
                'title' => 'Vitamin E Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:03',
                'updated_at' => '2023-04-07 09:04:03',
            ),
            29 => 
            array (
                'id' => 30,
                'trait_category_id' => 1,
                'title' => 'Vitamin K Metabolism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:03',
                'updated_at' => '2023-04-07 09:04:03',
            ),
            30 => 
            array (
                'id' => 31,
                'trait_category_id' => 2,
                'title' => 'Achilles Tendinopathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:05',
                'updated_at' => '2023-04-07 09:04:05',
            ),
            31 => 
            array (
                'id' => 32,
                'trait_category_id' => 2,
                'title' => 'Aerobic Capacity Trainability',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:05',
                'updated_at' => '2023-04-07 09:04:05',
            ),
            32 => 
            array (
                'id' => 33,
                'trait_category_id' => 2,
                'title' => 'Anterior Cruciate Ligament Injury',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:05',
                'updated_at' => '2023-04-07 09:04:05',
            ),
            33 => 
            array (
                'id' => 34,
                'trait_category_id' => 2,
                'title' => 'Concussion',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:05',
                'updated_at' => '2023-04-07 09:04:05',
            ),
            34 => 
            array (
                'id' => 35,
                'trait_category_id' => 2,
                'title' => 'Endurance',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:05',
                'updated_at' => '2023-04-07 09:04:05',
            ),
            35 => 
            array (
                'id' => 36,
                'trait_category_id' => 2,
                'title' => 'Fat Loss Response to Exercise',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:06',
                'updated_at' => '2023-04-07 09:04:06',
            ),
            36 => 
            array (
                'id' => 37,
                'trait_category_id' => 2,
                'title' => 'Flexibility',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:06',
                'updated_at' => '2023-04-07 09:04:06',
            ),
            37 => 
            array (
                'id' => 38,
                'trait_category_id' => 2,
                'title' => 'Lactate Threshold',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:06',
                'updated_at' => '2023-04-07 09:04:06',
            ),
            38 => 
            array (
                'id' => 39,
                'trait_category_id' => 2,
                'title' => 'Muscle Damage & Recovery',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:06',
                'updated_at' => '2023-04-07 09:04:06',
            ),
            39 => 
            array (
                'id' => 40,
                'trait_category_id' => 2,
                'title' => 'Muscle Injury',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:06',
                'updated_at' => '2023-04-07 09:04:06',
            ),
            40 => 
            array (
                'id' => 41,
                'trait_category_id' => 2,
                'title' => 'Power',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:07',
                'updated_at' => '2023-04-07 09:04:07',
            ),
            41 => 
            array (
                'id' => 42,
                'trait_category_id' => 2,
                'title' => 'Resistance Training and Muscle Building',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:07',
                'updated_at' => '2023-04-07 09:04:07',
            ),
            42 => 
            array (
                'id' => 43,
                'trait_category_id' => 2,
                'title' => 'Rotator Cuff Injury',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:07',
                'updated_at' => '2023-04-07 09:04:07',
            ),
            43 => 
            array (
                'id' => 44,
                'trait_category_id' => 2,
                'title' => 'Tennis Elbow',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:07',
                'updated_at' => '2023-04-07 09:04:07',
            ),
            44 => 
            array (
                'id' => 45,
                'trait_category_id' => 3,
                'title' => 'Alcohol Addiction',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:11',
                'updated_at' => '2023-04-07 09:04:11',
            ),
            45 => 
            array (
                'id' => 46,
                'trait_category_id' => 3,
                'title' => 'Cannabis Addiction',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:11',
                'updated_at' => '2023-04-07 09:04:11',
            ),
            46 => 
            array (
                'id' => 47,
                'trait_category_id' => 3,
                'title' => 'Cocaine Addiction',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:11',
                'updated_at' => '2023-04-07 09:04:11',
            ),
            47 => 
            array (
                'id' => 48,
                'trait_category_id' => 3,
                'title' => 'Heroin Addiction',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:11',
                'updated_at' => '2023-04-07 09:04:11',
            ),
            48 => 
            array (
                'id' => 49,
                'trait_category_id' => 3,
                'title' => 'Nicotine Addiction',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:11',
                'updated_at' => '2023-04-07 09:04:11',
            ),
            49 => 
            array (
                'id' => 50,
                'trait_category_id' => 3,
                'title' => 'Opioid Addiction',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:12',
                'updated_at' => '2023-04-07 09:04:12',
            ),
            50 => 
            array (
                'id' => 51,
                'trait_category_id' => 4,
                'title' => 'Acne',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:15',
                'updated_at' => '2023-04-07 09:04:15',
            ),
            51 => 
            array (
                'id' => 52,
                'trait_category_id' => 4,
                'title' => 'Alopecia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:16',
                'updated_at' => '2023-04-07 09:04:16',
            ),
            52 => 
            array (
                'id' => 53,
                'trait_category_id' => 4,
                'title' => 'Eczema',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:16',
                'updated_at' => '2023-04-07 09:04:16',
            ),
            53 => 
            array (
                'id' => 54,
                'trait_category_id' => 4,
                'title' => 'Pemphigus foliaceus',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:16',
                'updated_at' => '2023-04-07 09:04:16',
            ),
            54 => 
            array (
                'id' => 55,
                'trait_category_id' => 4,
                'title' => 'Psoriasis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:16',
                'updated_at' => '2023-04-07 09:04:16',
            ),
            55 => 
            array (
                'id' => 56,
                'trait_category_id' => 4,
                'title' => 'Striae Distensae',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:16',
                'updated_at' => '2023-04-07 09:04:16',
            ),
            56 => 
            array (
                'id' => 57,
                'trait_category_id' => 4,
                'title' => 'Sun Spots',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:17',
                'updated_at' => '2023-04-07 09:04:17',
            ),
            57 => 
            array (
                'id' => 58,
                'trait_category_id' => 4,
                'title' => 'Sunburns',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:17',
                'updated_at' => '2023-04-07 09:04:17',
            ),
            58 => 
            array (
                'id' => 59,
                'trait_category_id' => 4,
                'title' => 'Tanning ability',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:18',
                'updated_at' => '2023-04-07 09:04:18',
            ),
            59 => 
            array (
                'id' => 60,
                'trait_category_id' => 4,
                'title' => 'Vitiligo',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:18',
                'updated_at' => '2023-04-07 09:04:18',
            ),
            60 => 
            array (
                'id' => 61,
                'trait_category_id' => 5,
                'title' => 'Acromegaly',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:22',
                'updated_at' => '2023-04-07 09:04:22',
            ),
            61 => 
            array (
                'id' => 62,
                'trait_category_id' => 5,
                'title' => 'Addison\'s Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:22',
                'updated_at' => '2023-04-07 09:04:22',
            ),
            62 => 
            array (
                'id' => 63,
                'trait_category_id' => 5,
                'title' => 'Congenital Hypothyroidism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:23',
                'updated_at' => '2023-04-07 09:04:23',
            ),
            63 => 
            array (
                'id' => 64,
                'trait_category_id' => 5,
                'title' => 'Goiter',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:23',
                'updated_at' => '2023-04-07 09:04:23',
            ),
            64 => 
            array (
                'id' => 65,
                'trait_category_id' => 5,
                'title' => 'Graves\' Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:23',
                'updated_at' => '2023-04-07 09:04:23',
            ),
            65 => 
            array (
                'id' => 66,
                'trait_category_id' => 5,
                'title' => 'Growth Hormone Deficiency',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:23',
                'updated_at' => '2023-04-07 09:04:23',
            ),
            66 => 
            array (
                'id' => 67,
                'trait_category_id' => 5,
                'title' => 'Hashimoto\'s Thyroiditis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:23',
                'updated_at' => '2023-04-07 09:04:23',
            ),
            67 => 
            array (
                'id' => 68,
                'trait_category_id' => 5,
                'title' => 'Hypothyroidism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:24',
                'updated_at' => '2023-04-07 09:04:24',
            ),
            68 => 
            array (
                'id' => 69,
                'trait_category_id' => 5,
                'title' => 'Osteoporosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:24',
                'updated_at' => '2023-04-07 09:04:24',
            ),
            69 => 
            array (
                'id' => 70,
                'trait_category_id' => 5,
                'title' => ' ',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:24',
                'updated_at' => '2023-04-07 09:04:24',
            ),
            70 => 
            array (
                'id' => 71,
                'trait_category_id' => 5,
            'title' => 'Primary Aldosteronism (Hyperaldosteronism)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:24',
                'updated_at' => '2023-04-07 09:04:24',
            ),
            71 => 
            array (
                'id' => 72,
                'trait_category_id' => 5,
                'title' => 'Primary Hyperparathyroidism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:25',
                'updated_at' => '2023-04-07 09:04:25',
            ),
            72 => 
            array (
                'id' => 73,
                'trait_category_id' => 5,
                'title' => 'Type 1 Diabetes',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:25',
                'updated_at' => '2023-04-07 09:04:25',
            ),
            73 => 
            array (
                'id' => 74,
                'trait_category_id' => 5,
                'title' => ' ',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:25',
                'updated_at' => '2023-04-07 09:04:25',
            ),
            74 => 
            array (
                'id' => 75,
                'trait_category_id' => 5,
                'title' => 'Endometriosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:25',
                'updated_at' => '2023-04-07 09:04:25',
            ),
            75 => 
            array (
                'id' => 76,
                'trait_category_id' => 5,
                'title' => 'Leiomyoma',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:25',
                'updated_at' => '2023-04-07 09:04:25',
            ),
            76 => 
            array (
                'id' => 77,
                'trait_category_id' => 5,
                'title' => 'PCOS',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:26',
                'updated_at' => '2023-04-07 09:04:26',
            ),
            77 => 
            array (
                'id' => 78,
                'trait_category_id' => 5,
                'title' => 'Premature Ovarian Failure',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:26',
                'updated_at' => '2023-04-07 09:04:26',
            ),
            78 => 
            array (
                'id' => 79,
                'trait_category_id' => 5,
                'title' => 'Osteoporosis in Postmenopausal women',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:26',
                'updated_at' => '2023-04-07 09:04:26',
            ),
            79 => 
            array (
                'id' => 80,
                'trait_category_id' => 5,
                'title' => 'Gestational Diabetes',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:26',
                'updated_at' => '2023-04-07 09:04:26',
            ),
            80 => 
            array (
                'id' => 81,
                'trait_category_id' => 5,
                'title' => ' ',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:27',
                'updated_at' => '2023-04-07 09:04:27',
            ),
            81 => 
            array (
                'id' => 82,
                'trait_category_id' => 5,
                'title' => 'Erectile Dysfunction',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:27',
                'updated_at' => '2023-04-07 09:04:27',
            ),
            82 => 
            array (
                'id' => 83,
                'trait_category_id' => 5,
                'title' => 'Low Testosterone',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:27',
                'updated_at' => '2023-04-07 09:04:27',
            ),
            83 => 
            array (
                'id' => 84,
                'trait_category_id' => 5,
                'title' => 'Male Infertility',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:27',
                'updated_at' => '2023-04-07 09:04:27',
            ),
            84 => 
            array (
                'id' => 85,
                'trait_category_id' => 5,
                'title' => 'Prostate Enlargement',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:27',
                'updated_at' => '2023-04-07 09:04:27',
            ),
            85 => 
            array (
                'id' => 86,
                'trait_category_id' => 5,
                'title' => 'Gynecomastia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:04:28',
                'updated_at' => '2023-04-07 09:04:28',
            ),
            86 => 
            array (
                'id' => 87,
                'trait_category_id' => 6,
                'title' => 'Cardiovascular Diseases',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:13',
                'updated_at' => '2023-04-07 09:05:13',
            ),
            87 => 
            array (
                'id' => 88,
                'trait_category_id' => 6,
                'title' => 'Cholesterol Levels',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:14',
                'updated_at' => '2023-04-07 09:05:14',
            ),
            88 => 
            array (
                'id' => 89,
                'trait_category_id' => 6,
                'title' => 'Diabetic Cataract',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:14',
                'updated_at' => '2023-04-07 09:05:14',
            ),
            89 => 
            array (
                'id' => 90,
                'trait_category_id' => 6,
                'title' => 'Diabetic Nephropathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:14',
                'updated_at' => '2023-04-07 09:05:14',
            ),
            90 => 
            array (
                'id' => 91,
                'trait_category_id' => 6,
                'title' => 'Diabetic Neuropathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:14',
                'updated_at' => '2023-04-07 09:05:14',
            ),
            91 => 
            array (
                'id' => 92,
                'trait_category_id' => 6,
                'title' => 'Diabetic Retinopathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:15',
                'updated_at' => '2023-04-07 09:05:15',
            ),
            92 => 
            array (
                'id' => 93,
                'trait_category_id' => 6,
                'title' => 'Foot Ulcers',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:15',
                'updated_at' => '2023-04-07 09:05:15',
            ),
            93 => 
            array (
                'id' => 94,
                'trait_category_id' => 6,
                'title' => 'Obesity',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:15',
                'updated_at' => '2023-04-07 09:05:15',
            ),
            94 => 
            array (
                'id' => 95,
                'trait_category_id' => 6,
                'title' => 'Triglyceride Levels',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:15',
                'updated_at' => '2023-04-07 09:05:15',
            ),
            95 => 
            array (
                'id' => 96,
                'trait_category_id' => 6,
                'title' => 'Type II Diabetes',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:16',
                'updated_at' => '2023-04-07 09:05:16',
            ),
            96 => 
            array (
                'id' => 97,
                'trait_category_id' => 7,
                'title' => 'Alzheimer\'s Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:20',
                'updated_at' => '2023-04-07 09:05:20',
            ),
            97 => 
            array (
                'id' => 98,
                'trait_category_id' => 7,
                'title' => 'Amyotrophic Lateral Sclerosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:20',
                'updated_at' => '2023-04-07 09:05:20',
            ),
            98 => 
            array (
                'id' => 99,
                'trait_category_id' => 7,
                'title' => 'Anorexia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:20',
                'updated_at' => '2023-04-07 09:05:20',
            ),
            99 => 
            array (
                'id' => 100,
                'trait_category_id' => 7,
                'title' => 'Asperger\'s Syndrome',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:20',
                'updated_at' => '2023-04-07 09:05:20',
            ),
            100 => 
            array (
                'id' => 101,
                'trait_category_id' => 7,
            'title' => 'Attention Deficit Hyperactivity Disorder (ADHD)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:21',
                'updated_at' => '2023-04-07 09:05:21',
            ),
            101 => 
            array (
                'id' => 102,
                'trait_category_id' => 7,
                'title' => 'Autism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:21',
                'updated_at' => '2023-04-07 09:05:21',
            ),
            102 => 
            array (
                'id' => 103,
                'trait_category_id' => 7,
                'title' => 'Binge-eating Disorder',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:22',
                'updated_at' => '2023-04-07 09:05:22',
            ),
            103 => 
            array (
                'id' => 104,
                'trait_category_id' => 7,
                'title' => 'Bipolar Disorder',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:22',
                'updated_at' => '2023-04-07 09:05:22',
            ),
            104 => 
            array (
                'id' => 105,
                'trait_category_id' => 7,
                'title' => 'Bulimia Nervosa*',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:22',
                'updated_at' => '2023-04-07 09:05:22',
            ),
            105 => 
            array (
                'id' => 106,
                'trait_category_id' => 7,
                'title' => 'Depression',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:22',
                'updated_at' => '2023-04-07 09:05:22',
            ),
            106 => 
            array (
                'id' => 107,
                'trait_category_id' => 7,
                'title' => 'Dyslexia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:23',
                'updated_at' => '2023-04-07 09:05:23',
            ),
            107 => 
            array (
                'id' => 108,
                'trait_category_id' => 7,
                'title' => 'Epilepsy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:23',
                'updated_at' => '2023-04-07 09:05:23',
            ),
            108 => 
            array (
                'id' => 109,
                'trait_category_id' => 7,
                'title' => 'Essential Tremor',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:23',
                'updated_at' => '2023-04-07 09:05:23',
            ),
            109 => 
            array (
                'id' => 110,
                'trait_category_id' => 7,
                'title' => 'Fibromyalgia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:23',
                'updated_at' => '2023-04-07 09:05:23',
            ),
            110 => 
            array (
                'id' => 111,
                'trait_category_id' => 7,
                'title' => 'Frontotemporal Dementia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:23',
                'updated_at' => '2023-04-07 09:05:23',
            ),
            111 => 
            array (
                'id' => 112,
                'trait_category_id' => 7,
                'title' => 'Lewy Body Dementia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:24',
                'updated_at' => '2023-04-07 09:05:24',
            ),
            112 => 
            array (
                'id' => 113,
                'trait_category_id' => 7,
                'title' => 'Migraine',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:24',
                'updated_at' => '2023-04-07 09:05:24',
            ),
            113 => 
            array (
                'id' => 114,
                'trait_category_id' => 7,
                'title' => 'Multiple Sclerosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:24',
                'updated_at' => '2023-04-07 09:05:24',
            ),
            114 => 
            array (
                'id' => 115,
                'trait_category_id' => 7,
                'title' => 'Multiple System Atrophy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:24',
                'updated_at' => '2023-04-07 09:05:24',
            ),
            115 => 
            array (
                'id' => 116,
                'trait_category_id' => 7,
                'title' => 'Myasthenia Gravis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:25',
                'updated_at' => '2023-04-07 09:05:25',
            ),
            116 => 
            array (
                'id' => 117,
                'trait_category_id' => 7,
                'title' => 'Neuromyelitis Optica',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:25',
                'updated_at' => '2023-04-07 09:05:25',
            ),
            117 => 
            array (
                'id' => 118,
                'trait_category_id' => 7,
            'title' => 'Obsessive-Compulsive Disorder (OCD)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:25',
                'updated_at' => '2023-04-07 09:05:25',
            ),
            118 => 
            array (
                'id' => 119,
                'trait_category_id' => 7,
                'title' => 'Panic Disorder',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:25',
                'updated_at' => '2023-04-07 09:05:25',
            ),
            119 => 
            array (
                'id' => 120,
                'trait_category_id' => 7,
                'title' => 'Parkinson\'s Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:25',
                'updated_at' => '2023-04-07 09:05:25',
            ),
            120 => 
            array (
                'id' => 121,
                'trait_category_id' => 7,
                'title' => 'Phobic Disorders',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:26',
                'updated_at' => '2023-04-07 09:05:26',
            ),
            121 => 
            array (
                'id' => 122,
                'trait_category_id' => 7,
                'title' => 'Progressive Supranuclear Palsy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:26',
                'updated_at' => '2023-04-07 09:05:26',
            ),
            122 => 
            array (
                'id' => 123,
                'trait_category_id' => 7,
                'title' => 'Schizophrenia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:27',
                'updated_at' => '2023-04-07 09:05:27',
            ),
            123 => 
            array (
                'id' => 124,
                'trait_category_id' => 8,
            'title' => 'Age Related Macular Degeneration (ARMD)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:31',
                'updated_at' => '2023-04-07 09:05:31',
            ),
            124 => 
            array (
                'id' => 125,
                'trait_category_id' => 8,
                'title' => 'Astigmatism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:31',
                'updated_at' => '2023-04-07 09:05:31',
            ),
            125 => 
            array (
                'id' => 126,
                'trait_category_id' => 8,
                'title' => 'Birdshot Chorioretinopathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:32',
                'updated_at' => '2023-04-07 09:05:32',
            ),
            126 => 
            array (
                'id' => 127,
                'trait_category_id' => 8,
                'title' => 'Cataract',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:32',
                'updated_at' => '2023-04-07 09:05:32',
            ),
            127 => 
            array (
                'id' => 128,
                'trait_category_id' => 8,
                'title' => 'Central Serous Chorioretinopathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:32',
                'updated_at' => '2023-04-07 09:05:32',
            ),
            128 => 
            array (
                'id' => 129,
                'trait_category_id' => 8,
                'title' => 'Glaucoma',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:33',
                'updated_at' => '2023-04-07 09:05:33',
            ),
            129 => 
            array (
                'id' => 130,
                'trait_category_id' => 8,
                'title' => 'Graves Ophthalmopathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:33',
                'updated_at' => '2023-04-07 09:05:33',
            ),
            130 => 
            array (
                'id' => 131,
                'trait_category_id' => 8,
                'title' => 'Hyperopia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:33',
                'updated_at' => '2023-04-07 09:05:33',
            ),
            131 => 
            array (
                'id' => 132,
                'trait_category_id' => 8,
                'title' => 'Keratoconjunctivitis sicca',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:33',
                'updated_at' => '2023-04-07 09:05:33',
            ),
            132 => 
            array (
                'id' => 133,
                'trait_category_id' => 8,
                'title' => 'Keratoconus',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:33',
                'updated_at' => '2023-04-07 09:05:33',
            ),
            133 => 
            array (
                'id' => 134,
                'trait_category_id' => 8,
                'title' => 'Myopia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:34',
                'updated_at' => '2023-04-07 09:05:34',
            ),
            134 => 
            array (
                'id' => 135,
                'trait_category_id' => 8,
                'title' => 'Polypoidal Choroidal Vasculopathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:34',
                'updated_at' => '2023-04-07 09:05:34',
            ),
            135 => 
            array (
                'id' => 136,
                'trait_category_id' => 8,
                'title' => 'Retinal Occlusion',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:34',
                'updated_at' => '2023-04-07 09:05:34',
            ),
            136 => 
            array (
                'id' => 137,
                'trait_category_id' => 8,
                'title' => 'Stargardt Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:34',
                'updated_at' => '2023-04-07 09:05:34',
            ),
            137 => 
            array (
                'id' => 138,
                'trait_category_id' => 9,
                'title' => 'Aggression',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:53',
                'updated_at' => '2023-04-07 09:05:53',
            ),
            138 => 
            array (
                'id' => 139,
                'trait_category_id' => 9,
                'title' => 'Agreeableness',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:53',
                'updated_at' => '2023-04-07 09:05:53',
            ),
            139 => 
            array (
                'id' => 140,
                'trait_category_id' => 9,
                'title' => 'Animal Lover',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:53',
                'updated_at' => '2023-04-07 09:05:53',
            ),
            140 => 
            array (
                'id' => 141,
                'trait_category_id' => 9,
                'title' => 'Cognitive Ability',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:54',
                'updated_at' => '2023-04-07 09:05:54',
            ),
            141 => 
            array (
                'id' => 142,
                'trait_category_id' => 9,
                'title' => 'Conscientiousness',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:54',
                'updated_at' => '2023-04-07 09:05:54',
            ),
            142 => 
            array (
                'id' => 143,
                'trait_category_id' => 9,
                'title' => 'Creativity',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:54',
                'updated_at' => '2023-04-07 09:05:54',
            ),
            143 => 
            array (
                'id' => 144,
                'trait_category_id' => 9,
                'title' => 'Empathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:55',
                'updated_at' => '2023-04-07 09:05:55',
            ),
            144 => 
            array (
                'id' => 145,
                'trait_category_id' => 9,
                'title' => 'Extraversion',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:55',
                'updated_at' => '2023-04-07 09:05:55',
            ),
            145 => 
            array (
                'id' => 146,
                'trait_category_id' => 9,
                'title' => 'Gambling Risk',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:55',
                'updated_at' => '2023-04-07 09:05:55',
            ),
            146 => 
            array (
                'id' => 147,
                'trait_category_id' => 9,
                'title' => 'Happiness',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:55',
                'updated_at' => '2023-04-07 09:05:55',
            ),
            147 => 
            array (
                'id' => 148,
                'trait_category_id' => 9,
                'title' => 'Harm Avoidance',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:55',
                'updated_at' => '2023-04-07 09:05:55',
            ),
            148 => 
            array (
                'id' => 149,
                'trait_category_id' => 9,
                'title' => 'Imagination',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:56',
                'updated_at' => '2023-04-07 09:05:56',
            ),
            149 => 
            array (
                'id' => 150,
                'trait_category_id' => 9,
                'title' => 'Impulsivity',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:56',
                'updated_at' => '2023-04-07 09:05:56',
            ),
            150 => 
            array (
                'id' => 151,
                'trait_category_id' => 9,
                'title' => 'Insightfulness',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:56',
                'updated_at' => '2023-04-07 09:05:56',
            ),
            151 => 
            array (
                'id' => 152,
                'trait_category_id' => 9,
                'title' => 'Introversion',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:56',
                'updated_at' => '2023-04-07 09:05:56',
            ),
            152 => 
            array (
                'id' => 153,
                'trait_category_id' => 9,
                'title' => 'Language Ability',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:57',
                'updated_at' => '2023-04-07 09:05:57',
            ),
            153 => 
            array (
                'id' => 154,
                'trait_category_id' => 9,
                'title' => 'Mathematical Ability',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:57',
                'updated_at' => '2023-04-07 09:05:57',
            ),
            154 => 
            array (
                'id' => 155,
                'trait_category_id' => 9,
                'title' => 'Memory Processing',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:57',
                'updated_at' => '2023-04-07 09:05:57',
            ),
            155 => 
            array (
                'id' => 156,
                'trait_category_id' => 9,
                'title' => 'Motivation',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:57',
                'updated_at' => '2023-04-07 09:05:57',
            ),
            156 => 
            array (
                'id' => 157,
                'trait_category_id' => 9,
                'title' => 'Motor Learning and Performance',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:57',
                'updated_at' => '2023-04-07 09:05:57',
            ),
            157 => 
            array (
                'id' => 158,
                'trait_category_id' => 9,
                'title' => 'Music',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:58',
                'updated_at' => '2023-04-07 09:05:58',
            ),
            158 => 
            array (
                'id' => 159,
                'trait_category_id' => 9,
                'title' => 'Neuroticism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:58',
                'updated_at' => '2023-04-07 09:05:58',
            ),
            159 => 
            array (
                'id' => 160,
                'trait_category_id' => 9,
                'title' => 'Novelty Seeking',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:58',
                'updated_at' => '2023-04-07 09:05:58',
            ),
            160 => 
            array (
                'id' => 161,
                'trait_category_id' => 9,
                'title' => 'Openness',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:58',
                'updated_at' => '2023-04-07 09:05:58',
            ),
            161 => 
            array (
                'id' => 162,
                'trait_category_id' => 9,
                'title' => 'Optimism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:59',
                'updated_at' => '2023-04-07 09:05:59',
            ),
            162 => 
            array (
                'id' => 163,
                'trait_category_id' => 9,
                'title' => 'Parenting',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:05:59',
                'updated_at' => '2023-04-07 09:05:59',
            ),
            163 => 
            array (
                'id' => 164,
                'trait_category_id' => 9,
                'title' => 'Reading Ability',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:00',
                'updated_at' => '2023-04-07 09:06:00',
            ),
            164 => 
            array (
                'id' => 165,
                'trait_category_id' => 9,
                'title' => 'Reward Dependence^',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:00',
                'updated_at' => '2023-04-07 09:06:00',
            ),
            165 => 
            array (
                'id' => 166,
                'trait_category_id' => 9,
                'title' => 'Risk Taking',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:00',
                'updated_at' => '2023-04-07 09:06:00',
            ),
            166 => 
            array (
                'id' => 167,
                'trait_category_id' => 9,
                'title' => 'Self-confidence',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:00',
                'updated_at' => '2023-04-07 09:06:00',
            ),
            167 => 
            array (
                'id' => 168,
                'trait_category_id' => 9,
                'title' => 'Sociality',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:00',
                'updated_at' => '2023-04-07 09:06:00',
            ),
            168 => 
            array (
                'id' => 169,
                'trait_category_id' => 9,
                'title' => 'Stress Response',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:01',
                'updated_at' => '2023-04-07 09:06:01',
            ),
            169 => 
            array (
                'id' => 170,
                'trait_category_id' => 9,
                'title' => 'Trading Ability',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:01',
                'updated_at' => '2023-04-07 09:06:01',
            ),
            170 => 
            array (
                'id' => 171,
                'trait_category_id' => 9,
                'title' => 'Trustfulness',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:01',
                'updated_at' => '2023-04-07 09:06:01',
            ),
            171 => 
            array (
                'id' => 172,
                'trait_category_id' => 9,
                'title' => 'Visual Ability',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:01',
                'updated_at' => '2023-04-07 09:06:01',
            ),
            172 => 
            array (
                'id' => 173,
                'trait_category_id' => 9,
                'title' => 'Withdrawn Behaviour',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:01',
                'updated_at' => '2023-04-07 09:06:01',
            ),
            173 => 
            array (
                'id' => 174,
                'trait_category_id' => 10,
                'title' => 'Childhood Nephrotic Syndrome',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:51',
                'updated_at' => '2023-04-07 09:06:51',
            ),
            174 => 
            array (
                'id' => 175,
                'trait_category_id' => 10,
                'title' => 'Chronic Glomerulonephritis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:52',
                'updated_at' => '2023-04-07 09:06:52',
            ),
            175 => 
            array (
                'id' => 176,
                'trait_category_id' => 10,
                'title' => 'Chronic Kidney Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:52',
                'updated_at' => '2023-04-07 09:06:52',
            ),
            176 => 
            array (
                'id' => 177,
                'trait_category_id' => 10,
                'title' => 'Focal Segmental Glomerulosclerosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:52',
                'updated_at' => '2023-04-07 09:06:52',
            ),
            177 => 
            array (
                'id' => 178,
                'trait_category_id' => 10,
                'title' => 'Hyperurecaemia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:52',
                'updated_at' => '2023-04-07 09:06:52',
            ),
            178 => 
            array (
                'id' => 179,
                'trait_category_id' => 10,
                'title' => 'Hypomagnesemia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:53',
                'updated_at' => '2023-04-07 09:06:53',
            ),
            179 => 
            array (
                'id' => 180,
                'trait_category_id' => 10,
                'title' => 'Idiopathic Membranous Nephropathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:53',
                'updated_at' => '2023-04-07 09:06:53',
            ),
            180 => 
            array (
                'id' => 181,
                'trait_category_id' => 10,
                'title' => 'IgA Nephropathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:53',
                'updated_at' => '2023-04-07 09:06:53',
            ),
            181 => 
            array (
                'id' => 182,
                'trait_category_id' => 10,
                'title' => 'Lupus Nephritis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:53',
                'updated_at' => '2023-04-07 09:06:53',
            ),
            182 => 
            array (
                'id' => 183,
                'trait_category_id' => 10,
                'title' => 'Polycystic Kidney Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:54',
                'updated_at' => '2023-04-07 09:06:54',
            ),
            183 => 
            array (
                'id' => 184,
                'trait_category_id' => 10,
                'title' => 'Renal Calculi',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:54',
                'updated_at' => '2023-04-07 09:06:54',
            ),
            184 => 
            array (
                'id' => 185,
                'trait_category_id' => 10,
                'title' => 'Vesicoureteric Reflux',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:06:54',
                'updated_at' => '2023-04-07 09:06:54',
            ),
            185 => 
            array (
                'id' => 186,
                'trait_category_id' => 11,
                'title' => 'Barrett Esophagus',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:36',
                'updated_at' => '2023-04-07 09:07:36',
            ),
            186 => 
            array (
                'id' => 187,
                'trait_category_id' => 11,
                'title' => 'Celiac Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:37',
                'updated_at' => '2023-04-07 09:07:37',
            ),
            187 => 
            array (
                'id' => 188,
                'trait_category_id' => 11,
                'title' => 'Cirrhosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:37',
                'updated_at' => '2023-04-07 09:07:37',
            ),
            188 => 
            array (
                'id' => 189,
                'trait_category_id' => 11,
                'title' => 'Crohn\'s Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:37',
                'updated_at' => '2023-04-07 09:07:37',
            ),
            189 => 
            array (
                'id' => 190,
                'trait_category_id' => 11,
                'title' => 'Gallstones',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:37',
                'updated_at' => '2023-04-07 09:07:37',
            ),
            190 => 
            array (
                'id' => 191,
                'trait_category_id' => 11,
            'title' => 'Irritable Bowel Syndrome (IBS)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:38',
                'updated_at' => '2023-04-07 09:07:38',
            ),
            191 => 
            array (
                'id' => 192,
                'trait_category_id' => 11,
            'title' => 'Nonalcoholic Fatty Liver Disease (NAFLD)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:38',
                'updated_at' => '2023-04-07 09:07:38',
            ),
            192 => 
            array (
                'id' => 193,
                'trait_category_id' => 11,
                'title' => 'Pancreatitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:38',
                'updated_at' => '2023-04-07 09:07:38',
            ),
            193 => 
            array (
                'id' => 194,
                'trait_category_id' => 11,
                'title' => 'Primary Biliary Cholangitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:38',
                'updated_at' => '2023-04-07 09:07:38',
            ),
            194 => 
            array (
                'id' => 195,
                'trait_category_id' => 11,
                'title' => 'Primary Sclerosing Cholangitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:38',
                'updated_at' => '2023-04-07 09:07:38',
            ),
            195 => 
            array (
                'id' => 196,
                'trait_category_id' => 11,
                'title' => 'Ulcerative Colitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:39',
                'updated_at' => '2023-04-07 09:07:39',
            ),
            196 => 
            array (
                'id' => 197,
                'trait_category_id' => 12,
                'title' => 'Antiphospholipid Syndrome',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:56',
                'updated_at' => '2023-04-07 09:07:56',
            ),
            197 => 
            array (
                'id' => 198,
                'trait_category_id' => 12,
                'title' => 'Asthma',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:56',
                'updated_at' => '2023-04-07 09:07:56',
            ),
            198 => 
            array (
                'id' => 199,
                'trait_category_id' => 12,
                'title' => 'Autoimmune Hemolytic Anemia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:56',
                'updated_at' => '2023-04-07 09:07:56',
            ),
            199 => 
            array (
                'id' => 200,
                'trait_category_id' => 12,
                'title' => 'Autoimmune Hepatitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:57',
                'updated_at' => '2023-04-07 09:07:57',
            ),
            200 => 
            array (
                'id' => 201,
                'trait_category_id' => 12,
                'title' => 'Autoimmune Pancreatitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:57',
                'updated_at' => '2023-04-07 09:07:57',
            ),
            201 => 
            array (
                'id' => 202,
                'trait_category_id' => 12,
                'title' => 'Behçet Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:57',
                'updated_at' => '2023-04-07 09:07:57',
            ),
            202 => 
            array (
                'id' => 203,
                'trait_category_id' => 12,
                'title' => 'Dermatomyositis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:58',
                'updated_at' => '2023-04-07 09:07:58',
            ),
            203 => 
            array (
                'id' => 204,
                'trait_category_id' => 12,
                'title' => 'Discoid Lupus',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:58',
                'updated_at' => '2023-04-07 09:07:58',
            ),
            204 => 
            array (
                'id' => 205,
                'trait_category_id' => 12,
                'title' => 'Giant Cell Arteritis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:58',
                'updated_at' => '2023-04-07 09:07:58',
            ),
            205 => 
            array (
                'id' => 206,
                'trait_category_id' => 12,
                'title' => 'Inflammatory Myopathy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:58',
                'updated_at' => '2023-04-07 09:07:58',
            ),
            206 => 
            array (
                'id' => 207,
                'trait_category_id' => 12,
                'title' => 'Interstitial Cystitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:58',
                'updated_at' => '2023-04-07 09:07:58',
            ),
            207 => 
            array (
                'id' => 208,
                'trait_category_id' => 12,
                'title' => 'Lichen Planus',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:59',
                'updated_at' => '2023-04-07 09:07:59',
            ),
            208 => 
            array (
                'id' => 209,
                'trait_category_id' => 12,
                'title' => 'Microscopic Polyangiitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:59',
                'updated_at' => '2023-04-07 09:07:59',
            ),
            209 => 
            array (
                'id' => 210,
                'trait_category_id' => 12,
                'title' => 'Mixed Connective Tissue Disease',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:07:59',
                'updated_at' => '2023-04-07 09:07:59',
            ),
            210 => 
            array (
                'id' => 211,
                'trait_category_id' => 12,
                'title' => 'Pemphigoid',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:00',
                'updated_at' => '2023-04-07 09:08:00',
            ),
            211 => 
            array (
                'id' => 212,
                'trait_category_id' => 12,
                'title' => 'Sjogren Syndrome',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:00',
                'updated_at' => '2023-04-07 09:08:00',
            ),
            212 => 
            array (
                'id' => 213,
                'trait_category_id' => 12,
                'title' => 'Systemic Lupus Erythematosus',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:00',
                'updated_at' => '2023-04-07 09:08:00',
            ),
            213 => 
            array (
                'id' => 214,
                'trait_category_id' => 12,
                'title' => 'Systemic Sclerosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:00',
                'updated_at' => '2023-04-07 09:08:00',
            ),
            214 => 
            array (
                'id' => 215,
                'trait_category_id' => 12,
                'title' => 'Uveitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:00',
                'updated_at' => '2023-04-07 09:08:00',
            ),
            215 => 
            array (
                'id' => 216,
                'trait_category_id' => 13,
                'title' => 'Allergic rhinitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:13',
                'updated_at' => '2023-04-07 09:08:13',
            ),
            216 => 
            array (
                'id' => 217,
                'trait_category_id' => 13,
                'title' => 'Hens Egg Allergy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:13',
                'updated_at' => '2023-04-07 09:08:13',
            ),
            217 => 
            array (
                'id' => 218,
                'trait_category_id' => 13,
                'title' => 'Irritant contact dermatitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:14',
                'updated_at' => '2023-04-07 09:08:14',
            ),
            218 => 
            array (
                'id' => 219,
                'trait_category_id' => 13,
                'title' => 'Latex allergy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:14',
                'updated_at' => '2023-04-07 09:08:14',
            ),
            219 => 
            array (
                'id' => 220,
                'trait_category_id' => 13,
                'title' => 'Olive pollen allergy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:14',
                'updated_at' => '2023-04-07 09:08:14',
            ),
            220 => 
            array (
                'id' => 221,
                'trait_category_id' => 13,
                'title' => 'Peanut Allergy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:15',
                'updated_at' => '2023-04-07 09:08:15',
            ),
            221 => 
            array (
                'id' => 222,
                'trait_category_id' => 14,
                'title' => 'Bruxism',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:49',
                'updated_at' => '2023-04-07 09:08:49',
            ),
            222 => 
            array (
                'id' => 223,
                'trait_category_id' => 14,
                'title' => 'Dental Caries',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:49',
                'updated_at' => '2023-04-07 09:08:49',
            ),
            223 => 
            array (
                'id' => 224,
                'trait_category_id' => 14,
                'title' => 'Dental Fluorosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:49',
                'updated_at' => '2023-04-07 09:08:49',
            ),
            224 => 
            array (
                'id' => 225,
                'trait_category_id' => 14,
                'title' => 'Developmental Defects of Enamel',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:50',
                'updated_at' => '2023-04-07 09:08:50',
            ),
            225 => 
            array (
                'id' => 226,
                'trait_category_id' => 14,
                'title' => 'Gingivitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:50',
                'updated_at' => '2023-04-07 09:08:50',
            ),
            226 => 
            array (
                'id' => 227,
                'trait_category_id' => 14,
                'title' => 'Malocclusion',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:50',
                'updated_at' => '2023-04-07 09:08:50',
            ),
            227 => 
            array (
                'id' => 228,
                'trait_category_id' => 14,
                'title' => 'Oral Lichen Planus',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:50',
                'updated_at' => '2023-04-07 09:08:50',
            ),
            228 => 
            array (
                'id' => 229,
                'trait_category_id' => 14,
                'title' => 'Peri-implantitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:51',
                'updated_at' => '2023-04-07 09:08:51',
            ),
            229 => 
            array (
                'id' => 230,
                'trait_category_id' => 14,
                'title' => 'Periodontitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:51',
                'updated_at' => '2023-04-07 09:08:51',
            ),
            230 => 
            array (
                'id' => 231,
                'trait_category_id' => 14,
                'title' => 'Recurrent Aphthous Stomatitis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:51',
                'updated_at' => '2023-04-07 09:08:51',
            ),
            231 => 
            array (
                'id' => 232,
                'trait_category_id' => 14,
                'title' => 'Temporomandibular Joint Disorder',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:51',
                'updated_at' => '2023-04-07 09:08:51',
            ),
            232 => 
            array (
                'id' => 233,
                'trait_category_id' => 14,
                'title' => 'Tooth Agenesis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:08:52',
                'updated_at' => '2023-04-07 09:08:52',
            ),
            233 => 
            array (
                'id' => 234,
                'trait_category_id' => 15,
                'title' => 'Embryo implantation rate',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:08',
                'updated_at' => '2023-04-07 09:09:08',
            ),
            234 => 
            array (
                'id' => 235,
                'trait_category_id' => 15,
                'title' => 'IVF Failure',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:08',
                'updated_at' => '2023-04-07 09:09:08',
            ),
            235 => 
            array (
                'id' => 236,
                'trait_category_id' => 15,
                'title' => 'Ovarian stimulation response',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:08',
                'updated_at' => '2023-04-07 09:09:08',
            ),
            236 => 
            array (
                'id' => 237,
                'trait_category_id' => 15,
                'title' => 'Pregnancy rate',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:09',
                'updated_at' => '2023-04-07 09:09:09',
            ),
            237 => 
            array (
                'id' => 238,
                'trait_category_id' => 15,
            'title' => 'Recurrent Implantation Failure (RIF)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:09',
                'updated_at' => '2023-04-07 09:09:09',
            ),
            238 => 
            array (
                'id' => 239,
                'trait_category_id' => 15,
            'title' => 'Recurrent Pregnancy Loss (RPL)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:09',
                'updated_at' => '2023-04-07 09:09:09',
            ),
            239 => 
            array (
                'id' => 240,
                'trait_category_id' => 16,
            'title' => 'Acute Respiratory Distress Syndrome (ARDS)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:28',
                'updated_at' => '2023-04-07 09:09:28',
            ),
            240 => 
            array (
                'id' => 241,
                'trait_category_id' => 16,
            'title' => 'Alpha-1 antitrypsin (AAT) Deficiency',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:28',
                'updated_at' => '2023-04-07 09:09:28',
            ),
            241 => 
            array (
                'id' => 242,
                'trait_category_id' => 16,
            'title' => 'Chronic Obstructive Pulmonary Disease (COPD)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:28',
                'updated_at' => '2023-04-07 09:09:28',
            ),
            242 => 
            array (
                'id' => 243,
                'trait_category_id' => 16,
                'title' => 'Emphysema',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:29',
                'updated_at' => '2023-04-07 09:09:29',
            ),
            243 => 
            array (
                'id' => 244,
                'trait_category_id' => 16,
                'title' => 'Pulmonary Fibrosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:29',
                'updated_at' => '2023-04-07 09:09:29',
            ),
            244 => 
            array (
                'id' => 245,
                'trait_category_id' => 16,
                'title' => 'Pulmonary Tuberculosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:29',
                'updated_at' => '2023-04-07 09:09:29',
            ),
            245 => 
            array (
                'id' => 246,
                'trait_category_id' => 16,
                'title' => 'Sarcoidosis',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:09:29',
                'updated_at' => '2023-04-07 09:09:29',
            ),
            246 => 
            array (
                'id' => 247,
                'trait_category_id' => 17,
                'title' => 'Insomnia',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:10:28',
                'updated_at' => '2023-04-07 09:10:28',
            ),
            247 => 
            array (
                'id' => 248,
                'trait_category_id' => 17,
                'title' => 'Morningness-Eveningness',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:10:29',
                'updated_at' => '2023-04-07 09:10:29',
            ),
            248 => 
            array (
                'id' => 249,
                'trait_category_id' => 17,
                'title' => 'Narcolepsy',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:10:29',
                'updated_at' => '2023-04-07 09:10:29',
            ),
            249 => 
            array (
                'id' => 250,
                'trait_category_id' => 17,
            'title' => 'Obstructive Sleep Apnea (OSA)',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:10:29',
                'updated_at' => '2023-04-07 09:10:29',
            ),
            250 => 
            array (
                'id' => 251,
                'trait_category_id' => 17,
                'title' => 'Restless Leg Syndrome',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:10:29',
                'updated_at' => '2023-04-07 09:10:29',
            ),
            251 => 
            array (
                'id' => 252,
                'trait_category_id' => 17,
                'title' => 'Sleep Duration',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:10:30',
                'updated_at' => '2023-04-07 09:10:30',
            ),
            252 => 
            array (
                'id' => 253,
                'trait_category_id' => 17,
                'title' => 'Sleep Latency',
                'suitable_for' => 0,
                'status' => 1,
                'created_at' => '2023-04-07 09:10:30',
                'updated_at' => '2023-04-07 09:10:30',
            ),
        ));
        
        
    }
}