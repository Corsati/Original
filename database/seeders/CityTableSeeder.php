<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $remote = isset($_SERVER["REMOTE_ADDR"]) ?? false;

        if($remote)
          $url = '/home/mahratko/public_html/routes/cities.json';
        else
          $url = '/home/mahratko/public_html/routes/cities.json';

        //$url = '/Users/ahmedtaha/Documents/work/backend/meetUp/routes/cities.json';



        $citiesJson =  file_get_contents($url,true);
        foreach (json_decode($citiesJson) as $city)
        {
            \App\Models\City::create([
                'name'          =>  ['ar' => $city->name_ar , 'en' => $city->name_en ],
                'country_id'    =>  \App\Models\Country::first()->id,
            ]);
        }
    }
}
