<?php

use Illuminate\Database\Seeder;

class VehicleImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\VehicleImage::create(array(
            'name' => 'peugeot_307.jpg',
            'vehicle_id' => \App\DBQuery::getVehicleWithoutId('Peugeot', '307')->id,
            'image_uri' => asset('storage/imgs/Peugeot_307/peugeot_307.jpg')
        ));
        \App\VehicleImage::create(array(
            'name' => 'peugeot_308.jpg',
            'vehicle_id' => \App\DBQuery::getVehicleWithoutId('Peugeot', '308')->id,
            'image_uri' => asset('storage/imgs/Peugeot_308/peugeot_308.jpg')
        ));
        \App\VehicleImage::create(array(
            'name' => 'renault_master.jpg',
            'vehicle_id' => \App\DBQuery::getVehicleWithoutId('Renault', 'Master')->id,
            'image_uri' => asset('storage/imgs/Renault_Master/renault_master.jpg')
        ));
        \App\VehicleImage::create(array(
            'name' => 'renault_traffic.jpg',
            'vehicle_id' => \App\DBQuery::getVehicleWithoutId('Renault', 'Traffic')->id,
            'image_uri' => asset('storage/imgs/Renault_Traffic/renault_traffic.jpg')
        ));
        \App\VehicleImage::create(array(
            'name' => 'kia_sedona.jpg',
            'vehicle_id' => \App\DBQuery::getVehicleWithoutId('Kia', 'Sedona')->id,
            'image_uri' => asset('storage/imgs/Kia_Sedona/kia_sedona.jpg')
        ));
        \App\VehicleImage::create(array(
            'name' => 'megane_convertable.jpg',
            'vehicle_id' => \App\DBQuery::getVehicleWithoutId('Megane', 'Convertable')->id,
            'image_uri' => asset('storage/imgs/Megane_Convertable/megane_convertable.jpg')
        ));
    }
}
