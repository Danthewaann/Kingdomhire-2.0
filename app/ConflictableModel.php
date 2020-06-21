<?php

namespace App;

use Exception;
use ReflectionClass;
use App\Reservation;
use App\Hire;
use Illuminate\Database\Eloquent\Model;

abstract class ConflictableModel extends Model
{
    /**
     * The child models that extend ConflictableModel.
     * 
     * @var array
     */
    private const CHILD_MODELS = [Reservation::class, Hire::class];

    /**
     * Conflict message string.
     * 
     * @var string
     */
    protected $conflictMessage = "conflicts with another model";

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [];

    /**
     * Does the model conflict with another ConflictableModel.
     * 
     * @var boolean
     */
    protected $conflicts = false;

    /**
     * The conflict event data for the model.
     * 
     * @var array
     */
    protected $conflictData = [
        'reservation' => null,
        'hire' => null,
        'start_date' => null,
        'end_date' => null,
    ];

    /**
     * Get the route key for the model.
     * 
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Get the conflict status of the model.
     * 
     * @return boolean
     */
    public function getConflictsAttribute()
    {
        return $this->conflicts;
    }

    /**
     * Get the conflict data of the model.
     * 
     * @return array
     */
    public function getConflictDataAttribute()
    {
        return $this->conflictData;
    }

    /**
     * Save the model instance into the database.
     * Only subclasses that extend ConflictableModel can call this function 
     * successfully, so direct instances of ConflictableModel cannot be saved
     * 
     * @return boolean 
     */
    public function save(array $options = [])
    {
        foreach (ConflictableModel::CHILD_MODELS as $model) {
            if ($this instanceof $model) {
                return parent::save($options); 
            }
        }
        throw new Exception('Cannot save direct instance of ConflictableModel!');
    }

    /**
     * Determine if this model conflicts with another ConflictableModel.
     * start and end dates from this model is compared against the time period
     * between the start and end dates of the other model.
     * If the dates from this model overlap with the other, then this model
     * conflicts with the other model.
     *
     * @param ConflictableModel $other
     * @return bool (true if it conflicts, false otherwise)
     */
    public function conflictsWith(ConflictableModel $other)
    {
        $this->conflicts = (
            $this->endConflicts($other) or
            $this->startAndEndConflicts($other) or
            $this->startConflicts($other)
        );
        return $this->conflicts;
    }

    /**
     * Determine if the start date of this model overlaps with the period of time
     * between the start and end date of the other model this is being compared
     * against.
     * 
     * @param ConflictableModel $other
     * @return bool (true if it conflicts, false otherwise)
     */
    private function startConflicts(ConflictableModel $other)
    {
        if ($this->start_date <= $other->end_date && $this->end_date > $other->end_date) {
            $this->conflictData['start_date'] = 'Start date '. $other->conflictMessage;
            $this->conflictData[(string) $other] = $other;
            return true;
        }
        return false;
    }

    /**
     * Determine if the end date of this model overlaps with the period of time
     * between the start and end date of the other model this is being compared
     * against.
     *
     * @param ConflictableModel $other
     * @return bool (true if it conflicts, false otherwise)
     */
    private function endConflicts(ConflictableModel $other)
    {
        if ($this->start_date < $other->start_date && $this->end_date >= $other->start_date) {
            $this->conflictData['end_date'] = 'End date '. $other->conflictMessage;
            $this->conflictData[(string) $other] = $other;
            return true;
        }
        return false;
    }

    /**
     * Determine if the start and end date of this model overlaps with the period of time
     * between the start and end date of the other model this is being compared
     * against.
     *
     * @param ConflictableModel $other
     * @return bool (true if it conflicts, false otherwise)
     */
    private function startAndEndConflicts(ConflictableModel $other)
    {
        if ($this->start_date >= $other->start_date && $this->end_date <= $other->end_date) {
            $this->conflictData['start_date'] = 'Start date '. $other->conflictMessage;
            $this->conflictData['end_date'] = 'End date '. $other->conflictMessage;
            $this->conflictData[(string) $other] = $other;
            return true;
        }
        return false;
    }

    /**
     * Create a unique model id that doesn't
     * conflict with any other `ConflictableModel` id that exists in the database.
     * 
     * @param Vehicle $vehicle vehicle to link against
     * @param int $length character length of generated id
     * @return string $id the newly generated id
     */
    public static function createUniqueId(Vehicle $vehicle, $length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $id = '';
        for ($i = 0; $i < $length; $i++) {
            $id .= $characters[rand(0, $charactersLength - 1)];
        }

        $id = $vehicle->name . '-' . $id;
        $modelIds = array_merge(
            $vehicle->reservations->pluck('name')->toArray(), 
            $vehicle->hires->pluck('name')->toArray()
        );

        if (in_array($id, $modelIds)) {
            return ConflictableModel::createUniqueId($vehicle, $length);
        }
        return $id;
    }

    /**
     * String representation of class instance.
     * 
     * @return string
     */
    public function __toString()
    {
        return strtolower((new ReflectionClass($this))->getShortName());
    }

    // abstract function to define relationship with Vehicle model.
    abstract public function vehicle(); 
}
