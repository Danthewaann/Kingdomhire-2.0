<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VehicleImage
 *
 * @property int $id
 * @property string $image_uri
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int|null $vehicle_id
 * @property-read \App\Vehicle|null $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereImageUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereVehicleId($value)
 * @mixin \Eloquent
 */
class VehicleImage extends Model
{
    protected $fillable = [
        'image_uri', 'vehicle_id', 'name', 'order'
    ];

    /**
     * Create a unique vehicle image name that doesn't
     * conflict with any vehicle image name that exists
     * in the database
     *
     * @param int $length character length of generated num for name
     * @return string the newly generated name
     */
    public static function createUniqueName($name, $vehicle_id, $length = 3)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $id = '';
        for ($i = 0; $i < $length; $i++) {
            $id .= $characters[rand(0, $charactersLength - 1)];
        }

        $new_name_arr = explode(".", $name);
        $new_name = $new_name_arr[0] . '_' . $id . '.' . $new_name_arr[1];
        $vehicle_image_names = VehicleImage::whereVehicleId($vehicle_id)->pluck('name')->toArray();
        if (in_array($new_name, $vehicle_image_names)) {
            return VehicleImage::createUniqueName($vehicleImage);
        }

        return $new_name;
    }

    /**
     * Get vehicle associated with the image
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function getNameWithoutExtension()
    {
        return explode(".", $this->name)[0];
    }
}
