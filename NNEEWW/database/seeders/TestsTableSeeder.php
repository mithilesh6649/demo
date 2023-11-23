<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class TestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
          Schema::disableForeignKeyConstraints();
        \DB::table('tests')->truncate();

        \DB::table('tests')->delete();
        
        \DB::table('tests')->insert(array (
            0 => 
            array (
                'add_info' => '<ul>
                <li>Coronary artery diseases&#39;</li>
                <li>Angina</li>
                <li>Heart failure</li>
                <li>Hypertension</li>
                <li>Stroke</li>
                <li>Sudden Cardiac death</li>
                <li>What drug should I use?</li>
                </ul>',
                'amount' => 0.0,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Lorem ipsum dolor sit amet elit ipsu consectetur adipisicing amet elit.',
                'id' => 2,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/obesity.png',
                'name' => 'Obesity',
                'status' => 1,
                'type' => '2',
                'updated_at' => '2023-01-05 04:58:08',
            ),
            1 => 
            array (
                'add_info' => '<ul>
                <li>Coronary artery diseases&#39;</li>
                <li>Angina</li>
                <li>Heart failure</li>
                <li>Hypertension</li>
                <li>Stroke</li>
                <li>Sudden Cardiac death</li>
                <li>What drug should I use?</li>
                </ul>',
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Lorem ipsum dolor sit amet elit ipsu consectetur adipisicing amet elit.',
                'id' => 3,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/diabetes.png',
                'name' => 'Diabetes',
                'status' => 1,
                'type' => '2',
                'updated_at' => '2023-01-02 04:16:42',
            ),
            2 => 
            array (
                'add_info' => '<ul>
                <li>Coronary artery diseases&#39;</li>
                <li>Angina</li>
                <li>Heart failure</li>
                <li>Hypertension</li>
                <li>Stroke</li>
                <li>Sudden Cardiac death</li>
                <li>What drug should I use?</li>
                </ul>',
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Lorem ipsum dolor sit amet elit ipsu consectetur adipisicing amet elit.',
                'id' => 4,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/heart_disorders.png',
                'name' => 'Heart Disorders',
                'status' => 1,
                'type' => '2',
                'updated_at' => '2023-01-02 04:28:26',
            ),
            3 => 
            array (
                'add_info' => '<ul>
                <li>Coronary artery diseases&#39;</li>
                <li>Angina</li>
                <li>Heart failure</li>
                <li>Hypertension</li>
                <li>Stroke</li>
                <li>Sudden Cardiac death</li>
                <li>What drug should I use?</li>
                </ul>',
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Lorem ipsum dolor sit amet elit ipsu consectetur adipisicing amet elit.',
                'id' => 5,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/renal_disorders.png',
                'name' => 'Renal Disorders',
                'status' => 1,
                'type' => '2',
                'updated_at' => '2023-01-02 04:30:10',
            ),
            4 => 
            array (
                'add_info' => '<ul>
                <li>Coronary artery diseases&#39;</li>
                <li>Angina</li>
                <li>Heart failure</li>
                <li>Hypertension</li>
                <li>Stroke</li>
                <li>Sudden Cardiac death</li>
                <li>What drug should I use?</li>
                </ul>',
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Lorem ipsum dolor sit amet elit ipsu consectetur adipisicing amet elit.',
                'id' => 6,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/pcos.png',
                'name' => 'PCOS',
                'status' => 1,
                'type' => '2',
                'updated_at' => '2023-01-02 04:32:31',
            ),
            5 => 
            array (
                'add_info' => '<ul>
                <li>Coronary artery diseases&#39;</li>
                <li>Angina</li>
                <li>Heart failure</li>
                <li>Hypertension</li>
                <li>Stroke</li>
                <li>Sudden Cardiac death</li>
                <li>What drug should I use?</li>
                </ul>',
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Lorem ipsum dolor sit amet elit ipsu consectetur adipisicing amet elit.',
                'id' => 7,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/skin_and_hair.png',
                'name' => 'Skin & Hair',
                'status' => 1,
                'type' => '2',
                'updated_at' => '2023-01-02 04:34:22',
            ),
            6 => 
            array (
                'add_info' => NULL,
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Manually enter details.........',
                'id' => 9,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/obesity_fatty_liver_organs.png',
                'name' => 'Obesity & Fatty Liver',
                'status' => 1,
                'type' => '3',
                'updated_at' => '2023-01-02 05:04:51',
            ),
            7 => 
            array (
                'add_info' => NULL,
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Manually enter details.........',
                'id' => 10,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/diabetes_organs.png',
                'name' => 'Diabetes',
                'status' => 1,
                'type' => '3',
                'updated_at' => '2023-01-02 05:06:14',
            ),
            8 => 
            array (
                'add_info' => NULL,
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Manually enter details.........',
                'id' => 11,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/heart_disorders_organs.png',
                'name' => 'Heart Disorders',
                'status' => 1,
                'type' => '3',
                'updated_at' => '2023-01-02 05:08:03',
            ),
            9 => 
            array (
                'add_info' => NULL,
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Manually enter details.........',
                'id' => 12,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/renel_disorders_organs.png',
                'name' => 'Renal Disorders',
                'status' => 1,
                'type' => '3',
                'updated_at' => '2023-01-02 05:09:07',
            ),
            10 => 
            array (
                'add_info' => NULL,
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Manually enter details.........',
                'id' => 13,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/pcos_organs.png',
                'name' => 'PCOS',
                'status' => 1,
                'type' => '3',
                'updated_at' => '2023-01-02 05:10:17',
            ),
            11 => 
            array (
                'add_info' => NULL,
                'amount' => NULL,
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Manually enter details.........',
                'id' => 14,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/skin_and_hair_organs.png',
                'name' => 'Skin & Hair',
                'status' => 1,
                'type' => '3',
                'updated_at' => '2023-01-02 05:11:53',
            ),
            12 => 
            array (
                'add_info' => NULL,
                'amount' => NULL,
                'created_at' => '2023-01-02 05:13:42',
                'deleted_at' => NULL,
                'description' => 'Manually enter details.........',
                'id' => 15,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/breast_cancer_organs.png',
                'name' => 'Breast Cancer',
                'status' => 1,
                'type' => '3',
                'updated_at' => '2023-01-02 05:13:42',
            ),
            13 => 
            array (
                'add_info' => NULL,
                'amount' => NULL,
                'created_at' => '2023-01-02 05:15:07',
                'deleted_at' => NULL,
                'description' => '<p>Manually enter details.........</p>',
                'id' => 16,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/prostate_organs.png',
                'name' => 'Prostate Cancer',
                'status' => 1,
                'type' => '3',
                'updated_at' => '2023-01-06 06:53:35',
            ),
            14 => 
            array (
                'add_info' => '<p>n publishing and graphic design, Lorem ipsum is a placeholder text commonly used to</p>',
                'amount' => 11999.0,
                'created_at' => '2023-01-05 03:57:02',
                'deleted_at' => NULL,
                'description' => 'Lorem ipsum dolor sit amet elit ipsu consectetur adipisicing amet elit.',
                'id' => 17,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/breast__cancer.png',
                'name' => 'Breast Cancer',
                'status' => 1,
                'type' => '4',
                'updated_at' => '2023-01-05 04:12:50',
            ),
            15 => 
            array (
                'add_info' => '<p>n publishing and graphic design, Lorem ipsum is a placeholder text commonly used to</p>',
                'amount' => 20000.0,
                'created_at' => '2023-01-05 03:58:09',
                'deleted_at' => NULL,
                'description' => 'Lorem ipsum dolor sit amet elit ipsu consectetur adipisicing amet elit.',
                'id' => 18,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/prostate__cancer.png',
                'name' => 'Prostate cancer',
                'status' => 1,
                'type' => '4',
                'updated_at' => '2023-01-05 04:13:45',
            ),
            16 => 
            array (
                'add_info' => '<p>n publishing and graphic design, Lorem ipsum is a placeholder text commonly used to</p>',
                'amount' => 11996.0,
                'created_at' => '2023-01-05 03:59:38',
                'deleted_at' => NULL,
                'description' => 'Lorem ipsum dolor sit amet elit ipsu consectetur adipisicing amet elit.',
                'id' => 19,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/pharmacogenetic.png',
                'name' => 'pharmacogenetic',
                'status' => 1,
                'type' => '4',
                'updated_at' => '2023-01-05 04:15:01',
            ),
            17 => 
            array (
                'add_info' => '<p>Lorem ipsum, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in la</p>',
                'amount' => 10000.0,
                'created_at' => '2023-01-05 04:00:20',
                'deleted_at' => NULL,
                'description' => 'Lorem ipsum dolor sit amet elit ipsu consectetur adipisicing amet elit.',
                'id' => 20,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/exomeX.png',
                'name' => 'ExomeX',
                'status' => 1,
                'type' => '4',
                'updated_at' => '2023-01-05 04:15:49',
            ),
        ));


}
}