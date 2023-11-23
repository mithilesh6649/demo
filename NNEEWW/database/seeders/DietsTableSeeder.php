<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DietsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('diets')->delete();
        
        \DB::table('diets')->insert(array (
            0 => 
            array (
                'amount' => 1999.0,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => '<p style="text-align:justify">Are you looking for a diet that can help you lose weight while still enjoying delicious and satisfying meals? Look no further than the keto diet! We help you achieve your weight loss goals while enjoying all of your favorite foods. With a focus on high-fat, low-carb meals, it typically contains 70% fat, 20% protein, and only 10% carbs&#39;. The keto diet can help your body enter a state of ketosis, where it burns fat for fuel instead of carbs. This diet offers health benefits like improved blood sugar control and insulin sensitivity. Our keto diet plans are backed by science and designed for real, sustainable results. Try today and start seeing results! Should be followed under expert guidance.</p>',
                'diet_category_id' => 1,
                'discount' => NULL,
                'id' => 1,
                'image' => 'https://admin.genahealthx.com/images/diets/1676554416.svg',
                'status' => 1,
                'title' => 'Ketogenic Strict',
                'type' => 1,
                'updated_at' => '2023-04-17 01:53:44',
            ),
            1 => 
            array (
                'amount' => 1999.0,
                'created_at' => NULL,
                'deleted_at' => NULL,
            'description' => '<p style="text-align:justify">Do you have specific fitness goals and looking for a customized plan with lots of health benefits, then this diet plan is worth trying for. As the name suggests, this is a modified version of ketogenic diet. It can be: (i). Cyclical Keto Diet (CKD)- Includes 5 days of keto days and 2 days of high carb diet in a week. (ii). Targeted ketogenic diet (TKD): This diet allows you to add carbs around workouts. (iii). High protein ketogenic diet: Includes more proteins. With all the benefits of a keto diet get a plan perfectly designed as per your needs. Try our easy-to-follow plans under the guidance of experienced team and get desired results.</p>',
                'diet_category_id' => 1,
                'discount' => NULL,
                'id' => 2,
                'image' => 'https://admin.genahealthx.com/images/diets/1676554788.svg',
                'status' => 1,
                'title' => 'Modified Ketogenic',
                'type' => 1,
                'updated_at' => '2023-04-17 01:53:51',
            ),
            2 => 
            array (
                'amount' => 1999.0,
                'created_at' => NULL,
                'deleted_at' => NULL,
            'description' => '<p style="text-align:justify">Can&rsquo;t escape your food cravings? Then surely Intermittent fasting can be your savior. It offers a wider variety of food choices as typically it specifies WHEN to eat, rather than WHAT to eat. Intermittent fasting (IF) is an eating pattern that cycles between periods of fasting and eating. Acc to research, when you fast, human growth hormone levels go up, initiating fat-loss and muscle gain and insulin levels go down. Your body&rsquo;s cells also change the expression of genes and initiate important cellular repair processes. Don&rsquo;t wait, get personalised guidance in all the popular methods of IF. May it be (i) The 16/8 method: restricting your daily eating period to 8 hours and fast for 16 hours in between. (ii) Eat-Stop-Eat: This involves fasting for 24 hours, once or twice a week. (iii) The 5:2 diet: consume only 500&ndash;600 calories on two non-consecutive days of the week, but eat normally the other 5 days. We offer specialized guidance in all.</p>',
                'diet_category_id' => 1,
                'discount' => NULL,
                'id' => 3,
                'image' => 'https://admin.genahealthx.com/images/diets/1676554808.svg',
                'status' => 1,
                'title' => 'Intermittent fasting',
                'type' => 1,
                'updated_at' => '2023-04-17 01:53:58',
            ),
            3 => 
            array (
                'amount' => 1999.0,
                'created_at' => NULL,
                'deleted_at' => NULL,
            'description' => '<p style="text-align:justify">In these times when Pollution, Adulteration and Toxins are the part and parcel of almost all the eatables, Detox comes for rescue. Detoxification (detox) diets claim to clean your blood and eliminate harmful toxins from your body. They&rsquo;re claimed to aid various health problems. Our customised Detox Plans can bring about a clear improvement in skin tone, immunity and sleep quality. Detoxifying your body also gives you an energy boost and significantly reduces cravings. Not only does a detox cleanse your body from the inside, it also aids weight loss. With all these benefits we provide plans that are backed by scientific study and especially designed to cater to everyone&rsquo;s needs. You just have to give it a try.</p>',
                'diet_category_id' => 2,
                'discount' => NULL,
                'id' => 4,
                'image' => 'https://admin.genahealthx.com/images/diets/1676555016.svg',
                'status' => 1,
                'title' => 'Detox deit',
                'type' => 1,
                'updated_at' => '2023-04-17 01:52:46',
            ),
            4 => 
            array (
                'amount' => 1999.0,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => '<p style="text-align:justify">Immunity is the most talked about topic after the pandemic situation, the whole world has faced. Strong Immune system can act as a shield against ill-health. But the fact is, strong immunity can&rsquo;t be achieved in few days. Come join hands with our team and we can lead you to a journey, where, with lifestyle changes and complete dietary guidance you can achieve your desired health goals along with strong immunity. Our plan include diets designed as per your food choices, providing a balance of all the macro and micro nutrients in your diet to make sure your immunity is humming along at peak levels.</p>',
                'diet_category_id' => 2,
                'discount' => NULL,
                'id' => 5,
                'image' => 'https://admin.genahealthx.com/images/diets/1676555049.svg',
                'status' => 1,
                'title' => 'Immunity booster',
                'type' => 1,
                'updated_at' => '2023-04-17 01:52:58',
            ),
            5 => 
            array (
                'amount' => 1999.0,
                'created_at' => NULL,
                'deleted_at' => NULL,
            'description' => '<p style="text-align:justify">Are you aware of the memory related issues that are getting common with the fast-changing world. Memory is a faculty of mind by which data and information is encoded, stored and retrieved when needed. But this faculty gets weakened with age or due to various other reasons including stress, anxiety and other lifestyle disorders. A new avenue of research focuses on the relationship between gut microbes &mdash; tiny organisms in the digestive system &mdash; and aging-related processes that lead to Alzheimer&rsquo;s. Unlike other risk factors for we can&rsquo;t change, such as age and genetics, people can control lifestyle choices such as diet, exercise and cognitive training. We offer specialised diets like MIND (Mediterranean-DASH Intervention for neurodegenerative Delay) Diet which have proven to slower the cognitive decline. Also our team of experts can guide you in food choices which are good and also those have ill effect on our memory. Can give it a try as &ldquo;Prevention Is Better Than CURE&rdquo;</p>',
                'diet_category_id' => 2,
                'discount' => NULL,
                'id' => 6,
                'image' => 'https://admin.genahealthx.com/images/diets/1676555059.svg',
                'status' => 1,
                'title' => 'Memory protection',
                'type' => 1,
                'updated_at' => '2023-04-17 01:53:04',
            ),
            6 => 
            array (
                'amount' => 1999.0,
                'created_at' => NULL,
                'deleted_at' => NULL,
            'description' => '<p style="text-align:justify">Are you among those who are more inclined towards Ayurveda than modern diets, then we have a solution for you too. People with dominant Kapha (water+earth) element are people with strong built , stamina and digestion. At the same time these people are sensitive to cold and damp places so they need to keep themselves warm. A kapha dosh can lead to weight gain. Diabetes, fluid retention. Allergies, fatigue etc. Under the guidance of our trained team, know your body and get a get a plan customised according to what suits you the best and get your body free of kapha dosha.</p>',
                'diet_category_id' => 3,
                'discount' => NULL,
                'id' => 7,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/kapha.svg',
                'status' => 1,
                'title' => 'Kapha',
                'type' => 1,
                'updated_at' => '2023-04-17 01:53:12',
            ),
            7 => 
            array (
                'amount' => 1999.0,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => '<p style="text-align:justify">The &lsquo;Fire element, as the name suggests, governs the digestive power, &lsquo;agni&rsquo; in our body. Excess of it can cause discomfort and stomach related ailments. Summer is a season of pitha, so it is characteristics of being hot and oily. Apart from digestion excess pitha can lead to anger, irritability, bad breath, body odour, sweating, nausea etc. So if you are facing any of such symptoms of &lsquo;Pitha Dosha&rsquo; you are at the right place. Diet plans including different foods and flavours to balance the dosha and improve your digestion are available along with a trained guidance and support. Try and seek health benefits.</p>',
                'diet_category_id' => 3,
                'discount' => NULL,
                'id' => 8,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/pitta.svg',
                'status' => 1,
                'title' => 'Pitha',
                'type' => 1,
                'updated_at' => '2023-04-17 01:53:19',
            ),
            8 => 
            array (
                'amount' => 1999.0,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => '<p style="text-align:justify">The &lsquo;Air Element&rdquo; mainly predominates movements in the body and activities of the nervous system, have a thin light body frame, creative mind and are full of vivacity and energy. But when vatha imbalance happens, they can experience physical/bodily issues like constipation, hypertension, weakness, arthritis, restlessness and other stomach or digestion relater problems. If these sighs and sound familiar to you, don&rsquo;t let the dosha come in your way. Try our trusted plans and get a plan designed to pacify you dosha with soothing and flavour-full meals and regain your energy and health.</p>',
                'diet_category_id' => 3,
                'discount' => NULL,
                'id' => 9,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/vatta.svg',
                'status' => 1,
                'title' => 'Vatha',
                'type' => 1,
                'updated_at' => '2023-04-17 01:53:28',
            ),
            9 => 
            array (
                'amount' => 10000.0,
                'created_at' => '2023-05-18 05:11:31',
                'deleted_at' => NULL,
                'description' => '',
                'diet_category_id' => NULL,
                'discount' => 10.0,
                'id' => 10,
                'image' => NULL,
                'status' => 1,
                'title' => 'MetMax',
                'type' => 2,
                'updated_at' => '2023-05-18 05:11:31',
            ),
            10 => 
            array (
                'amount' => 7000.0,
                'created_at' => '2023-05-18 05:21:34',
                'deleted_at' => NULL,
                'description' => '',
                'diet_category_id' => NULL,
                'discount' => 10.0,
                'id' => 11,
                'image' => NULL,
                'status' => 1,
                'title' => 'GenaMet Smart',
                'type' => 2,
                'updated_at' => '2023-05-18 05:21:34',
            ),
            11 => 
            array (
                'amount' => 9000.0,
                'created_at' => '2023-05-18 05:43:09',
                'deleted_at' => NULL,
                'description' => '',
                'diet_category_id' => NULL,
                'discount' => 10.0,
                'id' => 12,
                'image' => NULL,
                'status' => 1,
                'title' => 'GenaMet Max',
                'type' => 2,
                'updated_at' => '2023-05-18 05:43:09',
            ),
            12 => 
            array (
                'amount' => 12500.0,
                'created_at' => '2023-05-18 06:01:48',
                'deleted_at' => NULL,
                'description' => '',
                'diet_category_id' => NULL,
                'discount' => 10.0,
                'id' => 13,
                'image' => NULL,
                'status' => 1,
                'title' => 'GenaMet Superme',
                'type' => 2,
                'updated_at' => '2023-05-18 06:01:48',
            ),
        ));
        
        
    }
}