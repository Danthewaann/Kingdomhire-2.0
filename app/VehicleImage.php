<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VehicleImage
 *
 * @property int $id
 * @property string $image_uri
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $vehicle_id
 * @property int $order
 * @property-read \App\Vehicle|null $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereImageUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereVehicleId($value)
 * @mixin \Eloquent
 */
class VehicleImage extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'image_uri', 'vehicle_id', 'name', 'order'
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'image_uri', 'name', 'order', 'order_key'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['order_key'];

    /**
     * Create a unique vehicle image name that doesn't
     * conflict with any vehicle image name that exists in the database.
     * 
     * @param string $extension vehicle image extension (.jpg etc)
     * @param int $vehicle_id vehicle id linked with image
     * @param int $length character length of generated num for name
     * @return string the newly generated name
     */
    public static function createUniqueName($extension, $vehicle_id, $length = 3)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $id = '';
        for ($i = 0; $i < $length; $i++) {
            $id .= $characters[rand(0, $charactersLength - 1)];
        }

        $new_name = $id . $extension;
        $vehicle_image_names = VehicleImage::whereVehicleId($vehicle_id)->pluck('name')->toArray();
        if (in_array($new_name, $vehicle_image_names)) {
            return VehicleImage::createUniqueName($extension, $vehicle_id, $length);
        }

        return $new_name;
    }

    /**
     * Get vehicle associated with the image.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    /**
     * Get the image order key, which is its name without its
     * extension, along with a `_order` suffix
     * e.g. image.jpg => image_order
     * 
     * @return string
     */
    public function getOrderKeyAttribute()
    {
        return explode(".", $this->name)[0] . "_order";
    }
}
