<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminsSeeder::class,
            PagesSeeder::class,
            RolesSeeder::class,
            PermissionsSeeder::class,
            DiseaseSeeder::class,
            FaqSeeder::class,
            MdDropdownSeeder::class,
            MediaSeeder::class,
            PagesSeeder::class,
            TestSeeder::class,
			LaboratorySeeder::class,
			LaboratoryMetaDataSeeder::class,
			LaboratoryTestSeeder::class,
            SpecializationSeeder::class,
			ClinicianSeeder::class,
			ClinicianMetaDataSeeder::class,
            ClinicianSpecializationSeeder::class,
 
             BlogSeeder::class,
              DietPlanFeatureSeeder::class,
               DietsTableSeeder::class,
                DietSubPlanSubscriptionMapsTableSeeder::class,
                 ClinicianSpecializationSeeder::class,
                  ClinicianSpecializationSeeder::class,
                   ClinicianSpecializationSeeder::class,
                    ClinicianSpecializationSeeder::class,
                     ClinicianSpecializationSeeder::class,
                      ClinicianSpecializationSeeder::class,
                       ClinicianSpecializationSeeder::class,
                        ClinicianSpecializationSeeder::class,
                         ClinicianSpecializationSeeder::class,
                          ClinicianSpecializationSeeder::class,

        ]);
 
        
 
    }
}
