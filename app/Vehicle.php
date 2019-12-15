<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * App\Vehicle
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $make
 * @property string $model
 * @property int $seats
 * @property string $status
 * @property int|null $vehicle_type_id
 * @property int|null $vehicle_fuel_type_id
 * @property int|null $vehicle_gear_type_id
 * @property int|null $weekly_rate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\VehicleFuelType|null $fuelType
 * @property-read \App\VehicleGearType|null $gearType
 * @property-read \App\Hire|null $active_hire
 * @property-read string|null $fuel_type_name
 * @property-read string $full_name
 * @property-read string|null $gear_type_name
 * @property-read \Collection $inactive_hires
 * @property-read string $make_model
 * @property-read \App\Reservation|null $next_reservation
 * @property-read string|null $type_name
 * @property-read string $weekly_rate_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Hire[] $hires
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\VehicleImage[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reservation[] $reservations
 * @property-read \App\VehicleType|null $type
 * @property-read \App\WeeklyRate|null $weeklyRate
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereVehicleFuelTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereVehicleGearTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereVehicleTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereWeeklyRateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle withAll()
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle withoutTrashed()
 * @mixin \Eloquent
 */
class Vehicle extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'make', 'model', 'seats', 'status',
        'vehicle_type_id', 'vehicle_gear_type_id', 
        'vehicle_fuel_type_id', 'weekly_rate_id'
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'make_model', 'full_name', 'name', 'slug',
        'next_reservation', 'active_hire', 'inactive_hires',
        'seats', 'status', 'images', 'type_name', 
        'fuel_type_name', 'gear_type_name', 'weekly_rate_name'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'make_model', 'full_name', 'next_reservation', 
        'active_hire', 'inactive_hires', 'type_name',
        'fuel_type_name', 'gear_type_name', 'weekly_rate_name'
    ];

    /**
     * Vehicle status messages.
     * 
     * @var array
     */
    public const STATUS_TYPES = [
        'Available',
        'Unavailable',
        'Out for hire'
    ];

    /**
     * Get the route key for the model.
     * 
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get reservations for the vehicle.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Get hires for the vehicle.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hires()
    {
        return $this->hasMany(Hire::class);
    }

    /**
     * Get weekly price rate for the vehicle.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function weeklyRate()
    {
        return $this->belongsTo(WeeklyRate::class, 'weekly_rate_id');
    }

    /**
     * Get vehicle type for the vehicle.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    /**
     * Get vehicle fuel type for the vehicle.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fuelType()
    {
        return $this->belongsTo(VehicleFuelType::class, 'vehicle_fuel_type_id');
    }

    /**
     * Get vehicle gear type for the vehicle.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gearType()
    {
        return $this->belongsTo(VehicleGearType::class, 'vehicle_gear_type_id');
    }

    /**
     * Get images associated with the vehicle
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(VehicleImage::class)->orderBy('order');
    }

    /**
     * Get the vehicle's make and model.
     * 
     * @return string
     */
    public function getMakeModelAttribute()
    {
        return sprintf('%s %s', $this->make, $this->model);
    }

    /**
     * Get the vehicle's full name (make + model + - + id).
     * 
     * @return string
     */
    public function getFullNameAttribute()
    {
        return sprintf('%s %s - %s', $this->make, $this->model, $this->name);
    }

    /**
     * Get the vehicle's type name.
     * 
     * @return string|null
     */
    public function getTypeNameAttribute()
    {
        return $this->type != null ? $this->type->name : null;
    }

    /**
     * Get the vehicle's fuel type name.
     * 
     * @return string|null
     */
    public function getFuelTypeNameAttribute()
    {
        return $this->fuelType != null ? $this->fuelType->name : null;
    }

    /**
     * Get the vehicle's gear type name.
     * 
     * @return string|null
     */
    public function getGearTypeNameAttribute()
    {
        return $this->gearType != null ? $this->gearType->name : null;
    }

    /**
     * Get the vehicle's weekly rate name.
     * 
     * @return string
     */
    public function getWeeklyRateNameAttribute()
    {
        return $this->weeklyRate != null ? $this->weeklyRate->name : null;
    }

    /**
     * Get the next reservation for this vehicle if it has any.
     * 
     * @return App\Reservation|null
     */
    public function getNextReservationAttribute()
    {
        if ($this->reservations->count() == 0) {
            return null;
        }
        else {
            return $this->reservations->sortBy('end_date')->first();
        }
    }

    /**
     * Get the active hire for this vehicle if it has one
     * 
     * @return App\Hire|null
     */
    public function getActiveHireAttribute()
    {
        return $this->hires->where('is_active', true)->first();
    }

    /**
     * Get all the inactive (past) hires for this vehicle if it has any.
     * 
     * @return Collection
     */
    public function getInactiveHiresAttribute()
    {
        return $this->hires->where('is_active', false);
    }

    /**
     * Query scope to return all relations with the vehicle.
     * 
     * @return void
     */
    public function scopeWithAll($query)
    {
        $query->with(
            'hires', 'reservations', 'type', 
            'fuelType', 'gearType', 'weeklyRate', 'images'
        );
    }

    /**
     * Create a unique vehicle id that doesn't
     * conflict with any vehicle id that exists in the database.
     * 
     * @param int $length character length of generated id
     * @return string the newly generated id
     */
    public static function createUniqueId($length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $id = '';
        for ($i = 0; $i < $length; $i++) {
            $id .= $characters[rand(0, $charactersLength - 1)];
        }

        $vehicle_ids = Vehicle::withTrashed()->pluck('name')->toArray();
        if (in_array($id, $vehicle_ids)) {
            return Vehicle::createUniqueId($length);
        }

        return $id;
    }

    /**
     * Get number of hires made in each unique year.
     * Returns an associate array with year => hires.
     * 
     * @return Collection
     */
    public function getYearlyHires()
    {
        $years = [];
        foreach ($this->inactive_hires as $hire) {
            $year = date('Y', strtotime($hire->end_date));
            if (!array_key_exists($year, $years)) {
                $years[$year] = 0;
            }
            $years[$year]++;
        }

        return collect($years)->sortKeysDesc();
    }

    /**
     * Get all the reservations and hires for this vehicle.
     * $reservationExcludeIds and $hireExcludeIds are arrays of reservation and hire ids 
     * to exclude from the returned collection of results.
     * 
     * @param $excludeIds array of reservation ids to exclude from return results
     * @param $excludeIds array of hire ids to exclude from return results
     * @return Collection
     */
    public function getReservationsAndHires(array $reservationExcludeIds = [], array $hireExcludeIds = [])
    {
        $hires = $this->hires->reject(function ($item) use ($hireExcludeIds) {
            return in_array($item->id, $hireExcludeIds);
        });
        $reservations = $this->reservations->reject(function ($item) use ($reservationExcludeIds) {
            return in_array($item->id, $reservationExcludeIds);
        });
        $reservationsAndHires = $reservations->merge($hires);
        return $reservationsAndHires;
    }

    /**
     * Link the provided images with this vehicle in the database and
     * save them in storage.
     * $imageOrders should be an associate array, where each key is the
     * name for an image (excluding its extension, like .jpg) 
     * with an `_order` suffix appended onto it. e.g. 'renault-master_order'.
     * The value of each key should be a integer, which is used 
     * to order images in ascending order so they are displayed in vehicle
     * image galleries in the expected order.
     * 
     * @param \Illuminate\Http\UploadedFile[]|array $images
     * @param array $imageOrders
     * @return void
     */
    public function linkImages(array $images, array $imageOrders = [])
    {
        $localFs = Storage::disk('local');
        $targetDir = 'imgs/'.$this->name;
        if (!empty($images)) {
            if (!$localFs->exists('public/'.$targetDir)) {
                $localFs->makeDirectory('public/'.$targetDir);
            }
        }

        foreach ($images as $image) {
            // image is a string representing absolute path to image on current file system
            if (is_string($image)) {
                $imageOrderKey = basename($image) . '_order';
                $extension = image_type_to_extension(getimagesize($image)[2]);
            }
            // or image is an instance of \Illuminate\Http\UploadedFile
            else {
                $imageOrderKey = $image->getClientOriginalName() . '_order';
                $extension = '.'.$image->extension();
            }

            // Generate unique name for the image
            $image_name = VehicleImage::createUniqueName($extension, $this->id);

            // Resize the image to 900x675
            $resize = Image::make($image)->resize(900, 675);

            // Store the image on the current file system
            $path = $targetDir.'/'.$image_name;
            $resize->save(storage_path('app/public/'.$path), 60);

            VehicleImage::create([
                'name' => $image_name,
                'image_uri' => 'storage/' . $path,
                'vehicle_id' => $this->id,
                'order' => array_key_exists($imageOrderKey, $imageOrders) ? $imageOrders[$imageOrderKey] : 1
            ]);
        }
    }

    /**
     * Delete the provided images for this vehicle in the database and
     * remove them from storage.
     * $images is an array of image names to delete.
     * If $images is empty, delete all images linked to this vehicle.
     * 
     * @param array $images
     * @return void
     */
    public function deleteImages(array $images = [])
    {
        if (!empty($images)) {
            foreach ($images as $image) {
                $imageInStorage = $this->images->where('name', $image)->first();
                unlink(storage_path('app/public/imgs/'.$this->name.'/'.$imageInStorage->name));
                $imageInStorage->delete();
            }
        }
        else {
            foreach ($this->images as $image) {
                unlink(storage_path('app/public/imgs/'.$this->name.'/'.$image->name));
                $image->delete();
            }
        }

        if ($this->images()->get()->count() == 0) {
            Storage::disk('local')->deleteDirectory('public/imgs/'.$this->name);
        }
    }

    /**
     * Update the order of images for this vehicle in the database.
     * $imageOrders should be an associate array, where each key is the
     * name for an image (excluding its extension, like .jpg) 
     * with an `_order` suffix appended onto it e.g. '1234_order'.
     * The value of each key should be a integer, which is used 
     * to order images in ascending order so they are displayed in vehicle
     * image galleries in the expected order.
     * 
     * @param array $imageOrders
     * @return void
     */
    public function updateOrderOfImages(array $imageOrders)
    {
        foreach ($this->images()->get() as $image) {
            $newOrderValue = array_key_exists($image->order_key, $imageOrders) ? $imageOrders[$image->order_key] : null;
            if ($newOrderValue != null) {
                $image->update(['order' => $newOrderValue]);
            }
        }
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        // If the user is a guest, hide specific attributes from them
        if (!auth()->check())
        {
            $this->makeHidden([
                'hires', 'reservations', 'active_hire', 'inactive_hires', 
                'next_reservation', 'status', 'weekly_rate_name'
            ]);
        }
        return parent::toArray();
    }
}
