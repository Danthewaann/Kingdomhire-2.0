<?php

namespace App;

use App\Events\VehicleCreating;
use App\Events\VehicleDeleting;
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
 * @property-read \App\WeeklyRate|null $rate
 * @mixin \Eloquent
 * @property int $id
 * @property string $make
 * @property string $model
 * @property string $fuel_type
 * @property string $gear_type
 * @property int $seats
 * @property int $is_active
 * @property string $status
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int|null $weekly_rate_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereFuelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereGearType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereVehicleRateId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle withoutTrashed()
 * @method static bool|null forceDelete()
 * @method static bool|null restore()
 */
class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'make', 'model', 'vehicle_fuel_type_id', 'vehicle_gear_type_id', 'seats',
        'status', 'vehicle_type_id', 'image_path', 'weekly_rate_id'
    ];

    public static $status = [
        'Available',
        'Unavailable',
        'Out for hire'
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => VehicleCreating::class,
        'deleting' => VehicleDeleting::class
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
     * conflict with any vehicle id that exists
     * in the database
     *
     * @param int $length character length of generated id
     * @return string the newly generated id
     */
    public static function createUniqueId($length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $vehicle_ids = Vehicle::withTrashed()->pluck('name')->toArray();
        if (in_array($randomString, $vehicle_ids)) {
            return Vehicle::createUniqueId();
        }

        return $randomString;
    }

    /**
     * Get reservations for the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Get hires for the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hires()
    {
        return $this->hasMany(Hire::class);
    }

    /**
     * Get weekly price rate for the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate()
    {
        return $this->belongsTo(WeeklyRate::class, 'weekly_rate_id');
    }

    /**
     * Get vehicle type for the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    /**
     * Get vehicle fuel type for the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fuelType()
    {
        return $this->belongsTo(VehicleFuelType::class, 'vehicle_fuel_type_id');
    }

    /**
     * Get vehicle gear type for the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gearType()
    {
        return $this->belongsTo(VehicleGearType::class, 'vehicle_gear_type_id');
    }

    /**
     * Get images associated with the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(VehicleImage::class)->orderBy('order');
    }

    /**
     * Get the vehicle name (make + model)
     * @return string
     */
    public function name()
    {
        return $this->make.' '.$this->model;
    }

    /**
     * Get the vehicle full name (make + model + id)
     * @return string
     */
    public function fullName()
    {
        return $this->make.' '.$this->model.' - '.$this->name;
    }

    /**
     * Get the vehicle storage friendly name (make + model + id)
     * @return string
     */
    public function storageName()
    {
        return str_slug($this->make.' '.$this->model.' '.$this->name);
    }

    /**
     * Get number of hires made in each unique year
     * @return Collection
     */
    public function getYearlyHires()
    {
        $years = [];
        foreach ($this->hires as $hire) {
            $year = date('Y', strtotime($hire->end_date));
            if (!array_key_exists($year, $years)) {
                $years[$year] = 0;
            }
            $years[$year]++;
        }

        return collect($years)->sortKeysDesc();
    }

    public function getNextReservation()
    {
        return $this->reservations->sortBy('end_date')->first();
    }

    public function hasActiveHire()
    {
        return $this->getActiveHire() != null;
    }

    public function getActiveHire()
    {
        return $this->hires->where('is_active', '=', true)->first();
    }

    public function getInactiveHires()
    {
        return $this->hires->where('is_active', '=', false);
    }

    public function getReservationsAndHires($except = [])
    {
        $items = collect();
        $items = $items->merge($this->hires);
        $items = $items->merge($this->reservations);
        if (!empty($except)) {
            $items = $items->reject(function ($item) use ($except) {
                return in_array($item->id, $except);
            });
        }

        return $items;
    }

    public function linkImages($images, $http_request=null)
    {
        $dir = 'imgs/'.$this->storageName();
        if (!empty($images)) {
            if (!Storage::disk('local')->exists('public/'.$dir)) {
                Storage::disk('local')->makeDirectory('public/'.$dir);
            }
        }
        foreach ($images as $image) {
            if (is_string($image)) {
                $info = getimagesize($image);
                $extension = image_type_to_extension($info[2]);
            }
            else {
                $extension = '.'.$image->extension();
            }

            $image_name = $this->storageName().$extension;
            $image_name = VehicleImage::createUniqueName($image_name, $this->id);
            $path = $dir.'/'.$image_name;

            $resize = Image::make($image)->widen(900);
            $resize->save(storage_path('app/public/'.$path), 60);

            VehicleImage::create([
                'name' => $image_name,
                'image_uri' => 'storage/' . $path,
                'vehicle_id' => $this->id,
                'order' => $http_request != null ? $http_request->get(explode(".", $image->getClientOriginalName())[0] . '_order') : 1
            ]);
        }
    }

    public function deleteImages($deleteImages = [])
    {
        if (!empty($deleteImages)) {
            foreach ($deleteImages as $deleteImage) {
                $imageInStorage = $this->images->where('name', $deleteImage)->first();
                unlink(storage_path('app/public/imgs/'.$this->storageName().'/'.$imageInStorage->name));
                $imageInStorage->delete();
            }
        }
        else {
            foreach ($this->images as $image) {
                unlink(storage_path('app/public/imgs/'.$this->storageName().'/'.$image->name));
                $image->delete();
            }
        }

        if (VehicleImage::whereVehicleId($this->id)->count() == 0) {
            Storage::disk('local')->deleteDirectory('public/imgs/'.$this->storageName());
        }
    }

    public function updateImageOrder($request)
    {
        foreach ($this->images()->get() as $image) {
            $order_key = $image->getNameWithoutExtension() . '_order';
            $new_order = $request->get($order_key);
            if ($new_order != null) {
                $image->order = $new_order;
                $image->save();
            }
        }
    }
}
