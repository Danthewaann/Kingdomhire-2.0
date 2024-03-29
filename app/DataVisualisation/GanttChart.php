<?php

namespace App\DataVisualisation;

use App\DataVisualisation\Swatkins\LaravelGantt\Gantt;

class GanttChart extends Gantt
{
    /**
     * Generates the html needed to display a gantt chart to
     * visualise the schedule for all vehicles
     * 
     * @return string $html
     */
    function render() {

        $html = array();

        // common styles
        $cellstyle  = 'style="line-height: ' . $this->options['cellheight'] . 'px; height: ' . $this->options['cellheight'] . 'px"';
        $wrapstyle  = 'style="width: ' . $this->options['cellwidth'] . 'px"';
        $totalstyle = 'style="width: ' . (count($this->days)*$this->options['cellwidth']) . 'px"';
        // start the diagram
        $html[] = '<figure class="gantt">';

        // set a title if available
        if($this->options['title']) {
            $html[] = '<figcaption>' . $this->options['title'] . '</figcaption>';
        }

        // sidebar with labels
        $html[] = '<aside>';
        $html[] = '<ul class="gantt-labels" style="margin-top: ' . (($this->options['cellheight']*2)-1) . 'px">';
        foreach($this->blocks as $i => $block) {
            $html[] = '<li class="gantt-label"><strong ' . $cellstyle . '>' . $block['label'] . '</strong></li>';
        }
        $html[] = '</ul>';
        $html[] = '</aside>';

        // data section
        $html[] = '<section class="gantt-data">';

        // data header section
        $html[] = '<header>';

        // months headers
        $html[] = '<ul class="gantt-months" ' . $totalstyle . '>';
        foreach($this->months as $month) {
            $html[] = '<li class="gantt-month" style="width: ' . ($this->options['cellwidth'] * $month->countDays()) . 'px"><strong ' . $cellstyle . '>' . $month->name() . '</strong></li>';
        }
        $html[] = '</ul>';

        // days headers
        $html[] = '<ul class="gantt-days" ' . $totalstyle . '>';
        foreach($this->days as $day) {

            $weekend = ($day->isWeekend()) ? ' weekend' : '';
            $today   = ($day->isToday())   ? ' today' : '';

            $html[] = '<li class="gantt-day' . $weekend . $today . '" ' . $wrapstyle . '><span ' . $cellstyle . '>' . $day->padded() . '</span></li>';
        }
        $html[] = '</ul>';

        // end header
        $html[] = '</header>';

        // main items
        $html[] = '<ul class="gantt-items" ' . $totalstyle . '>';

        foreach($this->blocks as $i => $block) {

            $html[] = '<li class="gantt-item">';

            // days
            $html[] = '<ul class="gantt-days">';
            foreach($this->days as $day) {

                $weekend = ($day->isWeekend()) ? ' weekend' : '';
                $today   = ($day->isToday())   ? ' today' : '';

                $html[] = '<li class="gantt-day' . $weekend . $today . '" ' . $wrapstyle . '><span ' . $cellstyle . '>' . $day . '</span></li>';
            }
            $html[] = '</ul>';

            // the block
            $days   = (($block['end'] - $block['start']) / $this->seconds);
            $offset = (($block['start'] - $this->first->month()->timestamp) / $this->seconds);
            $top    = round($i * ($this->options['cellheight'] + 1));
            $left   = round($offset * $this->options['cellwidth']);
            $width  = round($days * $this->options['cellwidth']-1);
            $height = round($this->options['cellheight']-1);
            $class  = ($block['class']) ? ' ' . $block['class'] : '';
            $html[] = '<span class="gantt-block' . $class . '" style="left: ' . $left . 'px; width: ' . $width . 'px; height: ' . $height . 'px"><strong class="gantt-block-label">' . $days . '</strong></span>';
            $html[] = '</li>';

        }

        $html[] = '</ul>';

        if($this->options['today']) {

            // today
            $today  = $this->cal->today();
            $offset = (($today->timestamp - $this->first->month()->timestamp) / $this->seconds);
            $left   = round($offset * $this->options['cellwidth']) + round(($this->options['cellwidth'] / 2) - 1);

            if($today->timestamp > $this->first->month()->firstDay()->timestamp && $today->timestamp < $this->last->month()->lastDay()->timestamp) {
                $html[] = '<time style="top: ' . ($this->options['cellheight'] * 2) . 'px; left: ' . $left . 'px" datetime="' . $today->format('Y-m-d') . '">Today</time>';
            }

        }

        // end data section
        $html[] = '</section>';

        // end diagram
        $html[] = '</figure>';

        return implode('', $html);

    }
}
