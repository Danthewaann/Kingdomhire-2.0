<?php

namespace App;

use App\Http\Requests\VehicleUpdateRequest;
use App\Http\Requests\VehicleStoreRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * App\Vehicle
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Hire[] $hires
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reservation[] $reservations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\VehicleImage[] $images
 * @property-read \App\WeeklyRate|null $weeklyRate
 * @property-read \App\Type|null $type
 * @property-read \App\FuelType|null $fuelType
 * @property-read \App\GearType|null $gearType
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $make
 * @property string $model
 * @property int $seats
 * @property string $status
 * @property string $type
 * @property string $fuel_type
 * @property string $gear_type
 * @property int|null $weekly_rate_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereFuelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereGearType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereWeeklyRateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle withoutTrashed()
 * @method static bool|null forceDelete()
 * @method static bool|null restore()
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
        'make', 'model', 'vehicle_fuel_type_id', 
        'vehicle_gear_type_id', 'seats', 'status', 
        'vehicle_type_id', 'weekly_rate_id'
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
            return Vehicle::createUniqueId();
        }

        return $id;
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
            'fuelType', 'gearType', 'WeeklyRate', 'images'
        );
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
        return $this->make.' '.$this->model;
    }

    /**
     * Get the vehicle's full name (make + model + - + id).
     * 
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->make.' '.$this->model.' - '.$this->name;
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
     * Get the next active hire for this vehicle if it has one
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
     * 
     * @param \Illuminate\Http\UploadedFile[]|array $images
     * @param VehicleUpdateRequest|VehicleStoreRequest $httpRequest
     * @return void
     */
    public function linkImages(array $images, $httpRequest = null)
    {
        $dir = 'imgs/'.$this->name;
        if (!empty($images)) {
            if (!Storage::disk('local')->exists('public/'.$dir)) {
                Storage::disk('local')->makeDirectory('public/'.$dir);
            }
        }

        foreach ($images as $image) {
            if (is_string($image)) {
                $extension = image_type_to_extension(getimagesize($image)[2]);
            }
            else {
                $extension = '.'.$image->extension();
            }

            $image_name = VehicleImage::createUniqueName($extension, $this->id);
            $path = $dir.'/'.$image_name;
            $resize = Image::make($image)->resize(900, 675);
            $resize->save(storage_path('app/public/'.$path), 60);

            VehicleImage::create([
                'name' => $image_name,
                'image_uri' => 'storage/' . $path,
                'vehicle_id' => $this->id,
                'order' => $httpRequest != null ? $httpRequest->get(explode(".", $image->getClientOriginalName())[0] . '_order') : 1
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
                $imageInStorage = $this->images()->whereName($image)->first();
                unlink(storage_path('app/public/imgs/'.$this->name.'/'.$imageInStorage->name));
                $imageInStorage->delete();
            }
        }
        else {
            foreach ($this->images() as $image) {
                unlink(storage_path('app/public/imgs/'.$this->name.'/'.$image->name));
                $image->delete();
            }
        }

        if (VehicleImage::whereVehicleId($this->id)->count() == 0) {
            Storage::disk('local')->deleteDirectory('public/imgs/'.$this->name);
        }
    }

    /**
     * Update the order of images for this vehicle in the database.
     * The `order` field in the vehicle_images table will be updated
     * with the new values passed in the $httpRequest.
     * 
     * @param VehicleUpdateRequest $httpRequest
     * @return void
     */
    public function updateImageOrder(VehicleUpdateRequest $httpRequest)
    {
        foreach ($this->images()->get() as $image) {
            $order_key = $image->getNameWithoutExtension() . '_order';
            $new_order = $httpRequest->get($order_key);
            if ($new_order != null) {
                $image->update(['order' => $new_order]);
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
