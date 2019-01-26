<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ConflictModel
 *
 * @mixin \Eloquent
 * @property string $start_date
 * @property string $end_date
 */
class ConflictableModel extends Model
{
    protected $conflict_message = "conflicts with another model";

    protected $fillable = ['id', 'start_date', 'end_date'];

    public function hasStarted()
    {
        return $this->start_date == date('Y-m-d');
    }

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
     * Determine if this model conflicts with another ConflictableModel.
     * start and end dates from this model is compared against the time period
     * between the start and end dates of the other model.
     * If the dates from this model overlap with the other, then this model
     * conflicts with the other model
     *
     * @param ConflictableModel $other
     * @param array $conflictMessages
     * @return bool (true if it conflicts, false otherwise)
     */
    public function conflictsWith(ConflictableModel $other, &$conflictMessages = [])
    {
        return (
            $this->endConflicts($other, $conflictMessages) or
            $this->startAndEndConflicts($other, $conflictMessages) or
            $this->startConflicts($other, $conflictMessages)
        );
    }

    /**
     * Determine if the start date of this model overlaps with the period of time
     * between the start and end date of the other model this is being compared
     * against.
     *
     * @param ConflictableModel $other
     * @param array $conflictMessages
     * @return bool (true if it conflicts, false otherwise)
     */
    private function startConflicts(ConflictableModel $other, &$conflictMessages = [])
    {
        if ($this->start_date <= $other->end_date && $this->end_date > $other->end_date) {
            $conflictMessages['start_date'] = 'Start date '. $other->conflict_message;
            $conflictMessages[(string) $other] = $other;
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
     * @param array $conflictMessages
     * @return bool (true if it conflicts, false otherwise)
     */
    private function endConflicts(ConflictableModel $other, &$conflictMessages = [])
    {
        if ($this->start_date < $other->start_date && $this->end_date >= $other->start_date) {
            $conflictMessages['end_date'] = 'End date '. $other->conflict_message;
            $conflictMessages[(string) $other] = $other;
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
     * @param array $conflictMessages
     * @return bool (true if it conflicts, false otherwise)
     */
    private function startAndEndConflicts(ConflictableModel $other, &$conflictMessages = [])
    {
        if ($this->start_date >= $other->start_date && $this->end_date <= $other->end_date) {
            $conflictMessages['start_date'] = 'Start date '. $other->conflict_message;
            $conflictMessages['end_date'] = 'End date '. $other->conflict_message;
            $conflictMessages[(string) $other] = $other;
            return true;
        }

        return false;
    }
}
