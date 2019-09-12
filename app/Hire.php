<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

/**
 * App\Hire
 *
 * @property int $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $vehicle_id
 * @property-read array $conflict_data
 * @property-read bool $conflicts
 * @property-read \App\Vehicle $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereVehicleId($value)
 * @mixin \Eloquent
 */
class Hire extends ConflictableModel
{
    /**
     * Conflict message string.
     * 
     * @var string
     */
    protected $conflictMessage = 'conflicts with current active hire';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['vehicle_id', 'start_date', 'end_date', 'is_active'];

    /**
     * Get vehicle associated with this hire.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id')->withTrashed();
    }

    /**
     * Get number of hires made in each unique year.
     * Can pass in a Collection instance to parse instead of retreiving all
     * the hires from the database.
     * 
     * @param Collection|null $hires
     * @return Collection
     */
    public static function getYearlyHires(Collection $hires = null)
    {
        $years = [];
        if ($hires == null) {
            $hires = Hire::all();
        }
        foreach ($hires as $hire) {
            // Get the year that the current hire ends in
            $year = date('Y', strtotime($hire->end_date));
            // If the year doesn't exist in $years, create $year => 0
            if (!array_key_exists($year, $years)) {
                $years[$year] = 0;
            }
            $years[$year]++;
        }
        return collect($years)->sortKeysDesc();
    }
}
