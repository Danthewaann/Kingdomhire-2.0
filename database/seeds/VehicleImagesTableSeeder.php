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
        DB::table('vehicle_images')->delete();
        $vehicles = Vehicle::withTrashed()->get();

        foreach ($vehicles as $vehicle) {
            $nameArr = explode(" ", str_slug($vehicle->make_model));
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
