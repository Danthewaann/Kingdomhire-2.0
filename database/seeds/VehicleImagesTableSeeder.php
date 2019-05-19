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
        VehicleImage::create([
            'name' => 'peugeot_307.jpg',
            'vehicle_id' => Vehicle::where([
                ['make', '=', 'Peugeot'],
                ['model', '=', '307']
            ])->first()->id,
            'image_uri' => asset('storage/imgs/Peugeot_307/peugeot_307.jpg')
        ]);
        VehicleImage::create([
            'name' => 'peugeot_308.jpg',
            'vehicle_id' => Vehicle::where([
                ['make', '=', 'Peugeot'],
                ['model', '=', '308']
            ])->first()->id,
            'image_uri' => asset('storage/imgs/Peugeot_308/peugeot_308.jpg')
        ]);
        VehicleImage::create([
            'name' => 'renault_master.jpg',
            'vehicle_id' => Vehicle::where([
                ['make', '=', 'Renault'],
                ['model', '=', 'Master']
            ])->first()->id,
            'image_uri' => asset('storage/imgs/Renault_Master/renault_master.jpg')
        ]);
        VehicleImage::create([
            'name' => 'renault_traffic.jpg',
            'vehicle_id' => Vehicle::where([
                ['make', '=', 'Renault'],
                ['model', '=', 'Traffic']
            ])->first()->id,
            'image_uri' => asset('storage/imgs/Renault_Traffic/renault_traffic.jpg')
        ]);
        VehicleImage::create([
            'name' => 'kia_sedona.jpg',
            'vehicle_id' => Vehicle::where([
                ['make', '=', 'Kia'],
                ['model', '=', 'Sedona']
            ])->first()->id,
            'image_uri' => asset('storage/imgs/Kia_Sedona/kia_sedona.jpg')
        ]);
        VehicleImage::create([
            'name' => 'megane_convertible.jpg',
            'vehicle_id' => Vehicle::where([
                ['make', '=', 'Megane'],
                ['model', '=', 'Convertible']
            ])->first()->id,
            'image_uri' => asset('storage/imgs/Megane_Convertible/megane_convertible.jpg')
        ]);
    }
}
