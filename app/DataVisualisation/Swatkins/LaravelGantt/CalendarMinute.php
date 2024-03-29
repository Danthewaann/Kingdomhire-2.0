<?php

namespace App\DataVisualisation\Swatkins\LaravelGantt;

class CalendarMinute extends CalendarObj {
    
    function int() {
        return $this->minuteINT;
    }
    
    function seconds() {
        
        $obj   = $this;
        $array = array();
        
        while($obj->minuteINT == $this->minuteINT) {
            $array[] = $obj;
            $obj = $obj->plus('1second')->second();
        }
        
        return new CalendarIterator($array);
        
    }
    
    function next() {
        return $this->plus('1minute')->minute();
    }
    
    function prev() {
        return $this->minus('1minute')->minute();
    }
    
}
