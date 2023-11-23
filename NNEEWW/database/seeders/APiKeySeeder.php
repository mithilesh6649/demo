<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class APiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('confidential_api_keys')->truncate();
        \DB::table('confidential_api_keys')->insert([
            [
                'slug' => 'zoom',
                'key' => 'Zoom',
                'key_slug' => 'zoom_client_id',
                'value' => 'V8BIrV0vSEyBiMK8YuwZfA'
            ],
            [
                'slug' => 'zoom',
                'key' => 'Zoom',
                'key_slug' => 'zoom_client_secret',
                'value' => 'f28fQWsI23s6KTSMHSojJGwaipNrcnyS'
            ],
            [
                'slug' => 'zoom',
                'key' => 'Zoom',
                'key_slug' => 'zoom_secret_token',
                'value' => 'rXEON8dGR_SITOM5XnOqjw'
            ],
            [
                'slug' => 'zoom',
                'key' => 'Zoom',
                'key_slug' => 'zoom_access_token',
                'value' =>null
            ],
            [
                'slug' => 'zoom',
                'key' => 'Zoom',
                'key_slug' => 'zoom_refresh_token',
                'value' =>null
            ],
        ]);
    }
}
