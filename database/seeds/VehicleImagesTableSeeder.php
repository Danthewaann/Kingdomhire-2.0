<?php

use Illuminate\Database\Seeder;
use App\Vehicle;
use App\VehicleImage;

class VehicleImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = Vehicle::all();

        foreach ($vehicles as $vehicle) {
            $nameArr = explode("-", $vehicle->storageName());
            $nameLen = count($nameArr);
            $name = $nameArr[0];
            for ($i = 1; $i < $nameLen - 1; $i++) {
                $name = $name . "-" . $nameArr[$i];
            }
        
            $dir = __DIR__.'/../../storage/app/test/imgs/';
            $imgs = glob($dir.$name.'/*');
            $vehicle->linkImages($imgs);
        }
    }
}
