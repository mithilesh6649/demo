<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MdDropdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \DB::table('md_dropdowns')->truncate();

        \DB::table('md_dropdowns')->insert([
            [
                'name' => 'Register OTP',
                'slug' => 'phone_user_registration',
                'module' => 'user',
                'value' => 'Dear Customer, your OTP for registration is ?. Use this OTP to validate your registration',
            ],

            [
                'name' => 'Validate Login OTP',
                'slug' => 'phone_user_login',
                'module' => 'user',
                'value' => 'Dear Customer, Your OTP is ?. Use this OTP to validate your login',
            ],

            [
                'name' => 'Little or No Activity',
                'slug' => 'health_activity',
                'module' => 'health_status',
                'value' => '1',
            ],

            [
                'name' => 'Lightly Active',
                'slug' => 'health_activity',
                'module' => 'health_status',
                'value' => '2',
            ],

            [
                'name' => 'Moderate Active',
                'slug' => 'health_activity',
                'module' => 'health_status',
                'value' => '3',
            ],

            [
                'name' => 'Very Active',
                'slug' => 'health_activity',
                'module' => 'health_status',
                'value' => '4',
            ],

            [
                'name' => 'Loose 0.2 kg per week',
                'slug' => 'weekly_goals',
                'module' => 'health_status',
                'value' => '1',
            ],

            [
                'name' => 'Loose 0.5 kg per week',
                'slug' => 'weekly_goals',
                'module' => 'health_status',
                'value' => '2',
            ],

            [
                'name' => 'Loose 0.8 kg per week',
                'slug' => 'weekly_goals',
                'module' => 'health_status',
                'value' => '3',
            ],

            [
                'name' => 'Loose 1 kg per week',
                'slug' => 'weekly_goals',
                'module' => 'health_status',
                'value' => '4',
            ],

            [
                'name' => 'Re Verification',
                'slug' => 'change_phone_number',
                'module' => 'user',
                'value' => 'Dear Customer, Your OTP is ?. Use this OTP for verification',
            ],

            [
                'name' => 'Lose Weight',
                'slug' => 'goal',
                'module' => 'health_status',
                'value' => 1,
            ],

            [
                'name' => 'Maintain Weight',
                'slug' => 'goal',
                'module' => 'health_status',
                'value' => 2,
            ],

            [
                'name' => 'Gain Weight',
                'slug' => 'goal',
                'module' => 'health_status',
                'value' => 3,
            ],
            [
                'name' => 'Home',
                'slug' => 'home_page',
                'module' => 'media_page',
                'value' => 1,
            ],
            [
                'name' => 'About Us',
                'slug' => 'about_us_page',
                'module' => 'media_page',
                'value' => 1,
            ],

            [
                'name' => 'Footer',
                'slug' => 'footer',
                'module' => 'media_page',
                'value' => 1,
            ],
            [
                'name' => 'Active',
                'slug' => 'status',
                'module' => '',
                'value' => 1,
            ],
            [
                'name' => 'Inactive',
                'slug' => 'status',
                'module' => '',
                'value' => 0,
            ],

            [
                'name' => 'Normal',
                'slug' => 'genetic_test_type',
                'module' => 'Genetic Test',
                'value' => 1,
            ],
            [
                'name' => 'Preventive Genetic',
                'slug' => 'genetic_test_type',
                'module' => 'Genetic Test',
                'value' => 2,
            ],
            [
                'name' => 'Organ',
                'slug' => 'genetic_test_type',
                'module' => 'Genetic Test',
                'value' => 3,
            ],
            [
                'name' => 'Diagnostic and PGx',
                'slug' => 'genetic_test_type',
                'module' => 'Genetic Test',
                'value' => 4,
            ],

            [
                'name' => 'Monthly',
                'slug' => 'subscription_plan_duration',
                'module' => 'Subscription Plans',
                'value' => 1,
            ],
            [
                'name' => 'Quarterly',
                'slug' => 'subscription_plan_duration',
                'module' => 'Subscription Plans',
                'value' => 3,
            ],
            [
                'name' => '6 Months',
                'slug' => 'subscription_plan_duration',
                'module' => 'Subscription Plans',
                'value' => 6,
            ],
            [
                'name' => 'Yearly',
                'slug' => 'subscription_plan_duration',
                'module' => 'Subscription Plans',
                'value' => 12,
            ],
            [
                'name' => 'Male',
                'slug' => 'gender',
                'module' => 'Gender Module',
                'value' => 'male',
            ],
            [
                'name' => 'Female',
                'slug' => 'gender',
                'module' => 'Gender Module',
                'value' => 'female',
            ],
            [
                'name' => 'Other',
                'slug' => 'gender',
                'module' => 'Gender Module',
                'value' => 'other',
            ],

            [
                'name' => 'Breakfast',
                'slug' => 'breakfast_meal',
                'module' => 'meals',
                'value' => config('common.images_path_prefix') . '/images/media/breakfast_meals.png',
            ],

            [
                'name' => 'Lunch',
                'slug' => 'lunch_meal',
                'module' => 'meals',
                'value' => config('common.images_path_prefix') . '/images/media/lunch_meals.png',
            ],

            [
                'name' => 'Snacks',
                'slug' => 'snack_meal',
                'module' => 'meals',
                'value' => config('common.images_path_prefix') . '/images/media/snacks_meals.png',
            ],

            [
                'name' => 'Dinner',
                'slug' => 'dinner_meal',
                'module' => 'meals',
                'value' => config('common.images_path_prefix') . '/images/media/dinner_meals.png',
            ],

            [
                'name' => 'Evening Diet',
                'slug' => 'meals',
                'module' => 'Meals',
                'value' => 5,
            ],

            [
                'name' => 'Excerise',
                'slug' => 'u_exercise',
                'module' => 'exercise_mod',
                'value' => config('common.images_path_prefix') . '/images/media/exercise_s.png',
            ],

            [
                'name' => 'Zoom',
                'slug' => 'zoom',
                'module' => 'confidential_api_key',
                'value' => 1,
            ],

            [
                'name' => 'Tablet',
                'slug' => 'medicine_type',
                'module' => 'medicine_tracker',
                'value' => 1,
            ],

            [
                'name' => 'Capsule',
                'slug' => 'medicine_type',
                'module' => 'medicine_tracker',
                'value' => 2,
            ],

            [
                'name' => 'Drop',
                'slug' => 'medicine_type',
                'module' => 'medicine_tracker',
                'value' => 3,
            ],

            [
                'name' => 'Puff',
                'slug' => 'medicine_type',
                'module' => 'medicine_tracker',
                'value' => 4,
            ],

            [
                'name' => 'Injection',
                'slug' => 'medicine_type',
                'module' => 'medicine_tracker',
                'value' => 5,
            ],

            [
                'name' => 'Spray',
                'slug' => 'medicine_type',
                'module' => 'medicine_tracker',
                'value' => 6,
            ],

            [
                'name' => 'Grams',
                'slug' => 'medicine_serving_unit',
                'module' => 'medicine_tracker',
                'value' => 1,
            ],

            [
                'name' => 'Micrograms',
                'slug' => 'medicine_serving_unit',
                'module' => 'medicine_tracker',
                'value' => 2,
            ],

            [
                'name' => 'MI',
                'slug' => 'medicine_serving_unit',
                'module' => 'medicine_tracker',
                'value' => 3,
            ],

            [
                'name' => 'Miligrams',
                'slug' => 'medicine_serving_unit',
                'module' => 'medicine_tracker',
                'value' => 4,
            ],

            [
                'name' => 'Tablespoon',
                'slug' => 'medicine_serving_unit',
                'module' => 'medicine_tracker',
                'value' => 5,
            ],

            [
                'name' => 'Teaspoon',
                'slug' => 'medicine_serving_unit',
                'module' => 'medicine_tracker',
                'value' => 6,
            ],

            [
                'name' => 'Water Reminder',
                'slug' => 'water_reminder',
                'module' => 'tracker',
                'value' => 1,
            ],

            [
                'name' => 'Medicine Reminder',
                'slug' => 'medicine_reminder',
                'module' => 'tracker',
                'value' => 2,
            ],

            [
                'name' => 'Pulse Reminder',
                'slug' => 'pulse_reminder',
                'module' => 'tracker',
                'value' => 3,
            ],

            [
                'name' => 'Weight Reminder',
                'slug' => 'weight_reminder',
                'module' => 'tracker',
                'value' => 4,
            ],

            [
                'name' => 'Step Reminder',
                'slug' => 'step_reminder',
                'module' => 'tracker',
                'value' => 5,
            ],

            [
                'name' => 'Nutrionist Notification',
                'slug' => 'nutrionist_notification',
                'module' => 'notification',
                'value' => 1,
            ],
            [
                'name' => 'Header',
                'slug' => 'header',
                'module' => 'media_page',
                'value' => 1,
            ],

            [
                'name' => 'High',
                'slug' => 'high_priority',
                'module' => 'ticket_priority',
                'value' => '#ff0000',
            ],

            [
                'name' => 'Medium',
                'slug' => 'medium_priority',
                'module' => 'ticket_priority',
                'value' => '#ffff00',
            ],

            [
                'name' => 'Low',
                'slug' => 'low_priority',
                'module' => 'ticket_priority',
                'value' => '#008000',
            ],

            [
                'name' => 'Support',
                'slug' => 'support_category',
                'module' => 'ticket_category',
                'value' => '#008000',
            ],

            [
                'name' => 'User',
                'slug' => 'user_category',
                'module' => 'ticket_category',
                'value' => '#008000',
            ],

            [
                'name' => 'Uncategorized',
                'slug' => 'uncategorize_category',
                'module' => 'ticket_category',
                'value' => '#008000',
            ],

            [
                'name' => 'Project Features',
                'slug' => 'pro_app_feature',
                'module' => 'pro_app_feature',
                'value' => 1,
            ],

            [
                'name' => 'App Features',
                'slug' => 'pro_app_feature',
                'module' => 'pro_app_feature',
                'value' => 0,
            ],

            [
                'name' => 'Allergy',
                'slug' => 'health_complaints',
                'module' => 'health_complaints',
                'value' => 0,
            ],

            [
                'name' => 'Disease',
                'slug' => 'health_complaints',
                'module' => 'health_complaints',
                'value' => 1,
            ],

            [
                'name' => 'Disorders',
                'slug' => 'health_complaints',
                'module' => 'health_complaints',
                'value' => 2,
            ],
            [
                'name' => 'General',
                'slug' => 'health_complaints',
                'module' => 'health_complaints',
                'value' => 3,
            ],
            [
                'name' => 'Our App',
                'slug' => 'our_app',
                'module' => 'media_page',
                'value' => 1,
            ],

            [
                'name' => 2,
                'slug' => 'any_two_pricing',
                'module' => 'genetic_test_pricing',
                'value' => 11999,
            ],
            [
                'name' => 6,
                'slug' => 'all_six_pricing',
                'module' => 'genetic_test_pricing',
                'value' => 15999,
            ],
            [
                'name' => 'tratits',
                'slug' => 'additional_traits',
                'module' => 'genetic_test_pricing',
                'value' => 1999,
            ],

            [
                'name' => 'Know More',
                'slug' => 'know_more',
                'module' => 'media_page',
                'value' => 1,
            ],

            [
                'name' => 'Careers',
                'slug' => 'careers',
                'module' => 'media_page',
                'value' => 1,
            ],

            [
                'name' => 'Food Allergy',
                'slug' => 'health_complaints',
                'module' => 'health_complaints',
                'value' => 4,
            ],

            [
                'name' => 'Food Preference',
                'slug' => 'food_preferences',
                'module' => 'health_complaints',
                'value' => 5,
            ],

            [
                'name' => 'Appointment requested',
                'slug' => 'appointment_requested',
                'module' => 'tracker',
                'value' => 5,
            ],

            [
                'name' => 'Appointment scheduled',
                'slug' => 'appointment_scheduled',
                'module' => 'tracker',
                'value' => 5,
            ],

            [
                'name' => 'Appointment updated',
                'slug' => 'appointment_updated',
                'module' => 'tracker',
                'value' => 5,
            ],

            [
                'name' => 'Appointment cancelled',
                'slug' => 'appointment_cancelled',
                'module' => 'tracker',
                'value' => 5,
            ],

            [
                'name' => 'Nutritionist Notification',
                'slug' => 'nutritionist_notification',
                'module' => 'notification_mod',
                'value' => 1,
            ],

            [
                'name' => 'Single',
                'slug' => 'marital_status',
                'module' => 'marital_status Module',
                'value' => 'single',
            ],
            [
                'name' => 'Married',
                'slug' => 'marital_status',
                'module' => 'marital_status Module',
                'value' => 'married',
            ],
            [
                'name' => 'Others',
                'slug' => 'marital_status',
                'module' => 'marital_status Module',
                'value' => 'other',
            ],

            [
                'name' => 'Normal',
                'slug' => 'normal',
                'module' => 'bowel_movements',
                'value' => 1,
            ],
            [
                'name' => 'Constipation',
                'slug' => 'constipation',
                'module' => 'bowel_movements',
                'value' => 2,
            ],
            [
                'name' => 'Diarrhoea',
                'slug' => 'diarrhoea',
                'module' => 'bowel_movements',
                'value' => 3,
            ],
            [
                'name' => 'Irregular',
                'slug' => 'irregular',
                'module' => 'bowel_movements',
                'value' => 4,
            ],

            [
                'name' => 'Less then 5h/night',
                'slug' => 'sleep_quality',
                'module' => 'Sleep Quality',
                'value' => 1,
            ],

            [
                'name' => '5h/night',
                'slug' => 'sleep_quality',
                'module' => 'Sleep Quality',
                'value' => 2,
            ],

            [
                'name' => 'Greater then 5h/night',
                'slug' => 'sleep_quality',
                'module' => 'Sleep Quality',
                'value' => 3,
            ],
            [
                'name' => '10h/night',
                'slug' => 'sleep_quality',
                'module' => 'Sleep Quality',
                'value' => 4,
            ],

            [
                'name' => 'Daily',
                'slug' => 'eating_pattern',
                'module' => 'eating_pattern',
                'value' => 1,
            ],
            [
                'name' => '2-3 times a week',
                'slug' => 'eating_pattern',
                'module' => 'eating_pattern',
                'value' => 2,
            ],
            [
                'name' => '4-6 times a week',
                'slug' => 'eating_pattern',
                'module' => 'eating_pattern',
                'value' => 3,
            ],
            [
                'name' => 'Occasionally',
                'slug' => 'eating_pattern',
                'module' => 'eating_pattern',
                'value' => 4,
            ],
            [
                'name' => 'Never',
                'slug' => 'eating_pattern',
                'module' => 'eating_pattern',
                'value' => 5,
            ],
            [
                'name' => 'Water Goal',
                'slug' => 'water_goal',
                'module' => 'water_goal',
                'value' => config('common.images_path_prefix') . '/images/media/water_glass.png',
            ],
            [
                'name' => 'Fasting Blood Sugar',
                'slug' => 'fasting_blood_sugar',
                'module' => 'user_clinical_goals',
                'value' => 1,
            ],
            [
                'name' => 'Random Blood Sugar',
                'slug' => 'random_blood_sugar',
                'module' => 'user_clinical_goals',
                'value' => 2,
            ],
            [
                'name' => 'HBA1C',
                'slug' => 'hbaic',
                'module' => 'user_clinical_goals',
                'value' => 3,
            ],
            [
                'name' => 'Cholesterol',
                'slug' => 'cholesterol',
                'module' => 'user_clinical_goals',
                'value' => 4,
            ],
            [
                'name' => 'HDL',
                'slug' => 'hdl',
                'module' => 'user_clinical_goals',
                'value' => 5,
            ],
            [
                'name' => 'LDL',
                'slug' => 'ldl',
                'module' => 'user_clinical_goals',
                'value' => 6,
            ],
            [
                'name' => 'Triglycerides',
                'slug' => 'triglycerides',
                'module' => 'user_clinical_goals',
                'value' => 7,

            ],

            [
                'name' => 'Daily calorie budget',
                'slug' => 'daily_calorie_budget',
                'module' => 'user_nutritional_goals',
                'value' => 'kcal',
            ],
            [
                'name' => 'Increase protein',
                'slug' => 'increase_protein',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],
            [
                'name' => 'Fats',
                'slug' => 'fats',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],
            [
                'name' => 'Carbohydrates',
                'slug' => 'carbohydrates',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],
            [
                'name' => 'Fibres',
                'slug' => 'fibres',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],
            [
                'name' => 'MUFA',
                'slug' => 'mufa',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],
            [
                'name' => 'Vitamin D',
                'slug' => 'vitamin_d',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Report Uploaded Noitification',
                'slug' => 'report_uploaded_notification',
                'module' => 'notification',
                'value' => 1,
            ],

            [
                'name' => 'Serum Creatinine',
                'slug' => 'serum_creatinine',
                'module' => 'user_clinical_goals',
                'value' => 7,

            ],

            [
                'name' => 'Heamoglobin',
                'slug' => 'heamoglobin',
                'module' => 'user_clinical_goals',
                'value' => 7,

            ],

            [
                'name' => 'Albumin',
                'slug' => 'albumin',
                'module' => 'user_clinical_goals',
                'value' => 7,

            ],

            [
                'name' => 'Calcium',
                'slug' => 'calcium',
                'module' => 'user_clinical_goals',
                'value' => 7,

            ],

            [
                'name' => 'Phosphorus',
                'slug' => 'phosphorus',
                'module' => 'user_clinical_goals',
                'value' => 7,

            ],

            [
                'name' => 'Energy',
                'slug' => 'energy',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Total lipid (fat)',
                'slug' => 'Total lipid (fat)',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Sugars',
                'slug' => 'sugars',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Protein',
                'slug' => 'Protein',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Cholesterol',
                'slug' => 'Cholesterol',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Sodium',
                'slug' => 'Sodium',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],
            [
                'name' => 'Calcium',
                'slug' => 'Calcium',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Magnesium',
                'slug' => 'Magnesium',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Potassium',
                'slug' => 'Potassium',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Iron',
                'slug' => 'Iron',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Phosphorus',
                'slug' => 'Phosphorus',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Vitamin A',
                'slug' => 'Vitamin A',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Vitamin B',
                'slug' => 'Vitamin B',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Thiamin',
                'slug' => 'Thiamin',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Riboflavin',
                'slug' => 'Riboflavin',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Niacin',
                'slug' => 'Niacin',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Vitamin B',
                'slug' => 'Vitamin B',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Vitamin D',
                'slug' => 'Vitamin D',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Vitamin E',
                'slug' => 'Vitamin E',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Vitamin K',
                'slug' => 'Vitamin K',
                'module' => 'user_nutritional_goals',
                'value' => 'g',
            ],

            [
                'name' => 'Genetic ( DNA ) Tests',
                'slug' => '1',
                'module' => 'your_health_guide_message',
                'value' => 'What time shall we contact you? Our health coach will contact you soon.',
            ],

            [
                'name' => 'Chronic Disease Management',
                'slug' => '8',
                'module' => 'your_health_guide_message',
                'value' => 'Chronic Disease Management Message',
            ],
            [
                'name' => 'Weight Loss Plan',
                'slug' => '9',
                'module' => 'your_health_guide_message',
                'value' => 'Weight Loss Plan Message',
            ],
            [
                'name' => 'Diet Plans',
                'slug' => '10',
                'module' => 'your_health_guide_message',
                'value' => 'Diet Plans Message',
            ],
            [
                'name' => 'Talk to a coach / Nutrionist / Doctor / Scientist',
                'slug' => '11',
                'module' => 'your_health_guide_message',
                'value' => 'Talk to a coach / Nutrionist / Doctor / Scientist Message',
            ],
            [
                'name' => 'I have some other Queries',
                'slug' => '12',
                'module' => 'your_health_guide_message',
                'value' => 'I have some other Queries',
            ],

            [
                'name' => 'Subscribe Now',
                'slug' => 'subscribe_now',
                'module' => 'media_page',
                'value' => 1,
            ],

            [
                'name' => '1 Month',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 1,
            ],

            [
                'name' => '2 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 2,
            ],

            [
                'name' => '3 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 3,
            ],

            [
                'name' => '4 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 4,
            ],

            [
                'name' => '5 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 5,
            ],

            [
                'name' => '6 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 6,
            ],

            [
                'name' => '7 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 7,
            ],

            [
                'name' => '8 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 8,
            ],

            [
                'name' => '9 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 9,
            ],

            [
                'name' => '10 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 10,
            ],

            [
                'name' => '11 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 11,
            ],

            [
                'name' => '12 Months',
                'slug' => 'plan_month_duration',
                'module' => 'plan_month_duration',
                'value' => 12,
            ],

            [
                'name' => 'Men',
                'slug' => 'rda_men',
                'module' => 'rda_group_categories',
                'value' => 'men',
            ],

            [
                'name' => 'Women',
                'slug' => 'rda_women',
                'module' => 'rda_group_categories',
                'value' => 'women',
            ],

            [
                'name' => 'Infants',
                'slug' => 'rda_infants',
                'module' => 'rda_group_categories',
                'value' => 'infants',
            ],

            [
                'name' => 'Children',
                'slug' => 'rda_children',
                'module' => 'rda_group_categories',
                'value' => 'children',
            ],

            [
                'name' => 'Boys',
                'slug' => 'rda_boys',
                'module' => 'rda_group_categories',
                'value' => 'boys',
            ],

            [
                'name' => 'Girls',
                'slug' => 'rda_girls',
                'module' => 'rda_group_categories',
                'value' => 'girls',
            ],

            [
                'name' => 'Sedentary work',
                'slug' => 'rda_men',
                'module' => 'rda_particulars_values',
                'value' => '1',
            ],

            [
                'name' => 'Moderate work',
                'slug' => 'rda_men',
                'module' => 'rda_particulars_values',
                'value' => '2',
            ],

            [
                'name' => 'Heavy work',
                'slug' => 'rda_men',
                'module' => 'rda_particulars_values',
                'value' => '3',
            ],

            [
                'name' => 'Sedentary work',
                'slug' => 'rda_women',
                'module' => 'rda_particulars_values',
                'value' => '4',
            ],

            [
                'name' => 'Moderate work',
                'slug' => 'rda_women',
                'module' => 'rda_particulars_values',
                'value' => '5',
            ],

            [
                'name' => 'Heavy work',
                'slug' => 'rda_women',
                'module' => 'rda_particulars_values',
                'value' => '6',
            ],

            [
                'name' => 'Pregnant woman',
                'slug' => 'rda_women',
                'module' => 'rda_particulars_values',
                'value' => '7',
            ],

            [
                'name' => 'Lactation 0-6 months',
                'slug' => 'rda_women',
                'module' => 'rda_particulars_values',
                'value' => '8',
            ],

            [
                'name' => 'Lactation 7-12 months',
                'slug' => 'rda_women',
                'module' => 'rda_particulars_values',
                'value' => '9',
            ],

            [
                'name' => '0-6 months',
                'slug' => 'rda_infants',
                'module' => 'rda_particulars_values',
                'value' => '10',
            ],

            [
                'name' => '6-12 months',
                'slug' => 'rda_infants',
                'module' => 'rda_particulars_values',
                'value' => '11',
            ],

            [
                'name' => 'Children 1-3 years',
                'slug' => 'rda_children',
                'module' => 'rda_particulars_values',
                'value' => '12',
            ],

            [
                'name' => 'Children 4-6 years',
                'slug' => 'rda_children',
                'module' => 'rda_particulars_values',
                'value' => '13',
            ],

            [
                'name' => 'Children 7-9 years',
                'slug' => 'rda_children',
                'module' => 'rda_particulars_values',
                'value' => '14',
            ],

            [
                'name' => 'Boy 10-12 years',
                'slug' => 'rda_boys',
                'module' => 'rda_particulars_values',
                'value' => '15',
            ],
            [
                'name' => 'Girl 10-12 years',
                'slug' => 'rda_girls',
                'module' => 'rda_particulars_values',
                'value' => '16',
            ],
            [
                'name' => 'Boy 13-15 years',
                'slug' => 'rda_boys',
                'module' => 'rda_particulars_values',
                'value' => '17',
            ],

            [
                'name' => 'Girl 13-15 years',
                'slug' => 'rda_girls',
                'module' => 'rda_particulars_values',
                'value' => '18',
            ],

            [
                'name' => 'Boy 16-17 years',
                'slug' => 'rda_boys',
                'module' => 'rda_particulars_values',
                'value' => '19',
            ],

            [
                'name' => 'Girl 16-17 years',
                'slug' => 'rda_girls',
                'module' => 'rda_particulars_values',
                'value' => '20',
            ],

            [
                'name' => 'Men 60 yrs',
                'slug' => 'rda_men',
                'module' => 'rda_particulars_values',
                'value' => '21',
            ],

            [
                'name' => 'Women 60 yrs',
                'slug' => 'rda_women',
                'module' => 'rda_particulars_values',
                'value' => '22',
            ],
            [
                'name' => 'Diet Plans Ex - General || Metabolic || DNA-Metabolic',
                'slug' => 'diet_subscription_feature_type',
                'module' => 'Diet Plan Module',
                'value' => '1',
            ],

            [
                'name' => 'Sub Diet Plans Ex - GenaMet Smart || GenaMet Max || GenaMet Superme',
                'slug' => 'diet_subscription_feature_type',
                'module' => 'Sub Diet Plan Module',
                'value' => '2',
            ],

            [
                'name' => 'Sub Diet Plan Duration Ex - 1 Month || 3 Months || 6 Months',
                'slug' => 'diet_subscription_feature_type',
                'module' => 'Sub Diet Plan Module',
                'value' => '3',
            ],

            [
                'name' => 'Percent',
                'slug' => 'food_unit',
                'module' => 'food_units',
                'value' => '%',
            ],
            [
                'name' => 'One kilocalorie',
                'slug' => 'food_unit',
                'module' => 'food_units',
                'value' => 'kcal',
            ],
            [
                'name' => 'Gram',
                'slug' => 'food_unit',
                'module' => 'food_units',
                'value' => 'g',
            ],
            [
                'name' => 'Milligram',
                'slug' => 'food_unit',
                'module' => 'food_units',
                'value' => 'mg',
            ],
            [
                'name' => 'Microgram',
                'slug' => 'food_unit',
                'module' => 'food_units',
                'value' => 'µg',
            ],

              [
                'name' => 'Milliliter',
                'slug' => 'food_unit',
                'module' => 'food_units',
                'value' => 'ml',
            ],

            



        ]);
}
}
