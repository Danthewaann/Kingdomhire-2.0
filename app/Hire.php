<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
    /**
     * Get vehicle associated with this hire
     */
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
