<?php

namespace App;

use App\Events\HireCreating;
use Illuminate\Database\Eloquent\Collection;

/**
 * App\Hire
 *
 * @property-read \App\Vehicle $vehicle
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $name
 * @property string $start_date
 * @property string $end_date
 * @property int $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $vehicle_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereVehicleId($value)
 */
class Hire extends ConflictableModel
{
    protected $fillable = ['vehicle_id', 'is_active', 'start_date', 'end_date', 'name'];

    protected $conflict_message = 'conflicts with current active hire';

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => HireCreating::class,
    ];

    /**
     * Get vehicle associated with this hire
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function __toString()
    {
        return "hire";
    }

    /**
     * Create a unique hire id that doesn't
     * conflict with any hire id that exists
     * in the database
     *
     * @param $vehicle_id
     * @param int $length character length of generated id
     * @return string the newly generated id
     */
    public static function createUniqueId($vehicle_id, $length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $id = $vehicle_id.'-'.$randomString;
        $hire_ids = Hire::all()->pluck('name')->toArray();
        if (in_array($id, $hire_ids)) {
            return Hire::createUniqueId($vehicle_id);
        }

        return $id;
    }

    /**
     * Get number of hires made in each unique year
     * @return Collection
     */
    public static function getYearlyHires()
    {
        $years = [];
        $hires = Hire::whereIsActive(false)->get();
        foreach ($hires as $hire) {
            $year = date('Y', strtotime($hire->end_date));
            if (!array_key_exists($year, $years)) {
                $years[$year] = 0;
            }
            $years[$year]++;
        }

        return collect($years)->sortKeysDesc();
    }
}
