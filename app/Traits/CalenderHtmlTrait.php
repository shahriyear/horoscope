<?php

namespace App\Traits;

use DateTime;
use Illuminate\Database\Eloquent\Collection;

trait CalenderHtmlTrait
{
    public function getDaysOfWeek():array
    {
        $days = ['Sun','Mon','Tues','Wed','Thurs','Fri','Sat'];
        return $days;
    }

    public function getMonthName(int $month):string
    {
        $dt = DateTime::createFromFormat('!m', $month);
        return $dt->format('F');
    }

    public function getDateComponents($date= null):DateTime
    {
        if ($date == null) {
            return new DateTime();
        }

        return new DateTime($date->year.'-'.$date->month.'-'.$date->day);
    }

    public function checkTodayDate($date):string
    {
        $today = $this->getDateComponents();
        $date = $this->getDateComponents($date);
        if ($today->format('y-m-d') == $date->format('y-m-d')) {
            return 'today-date';
        }
        return 'day-date';
    }


    public function getDayOfWeeksRow(array $weekNames):string
    {
        $row = '<tr>';
        foreach ($weekNames as $weekName) {
            $row.= sprintf('<th class="header">%s</th>', $weekName);
        }
        $row .= '</tr>';

        return $row;
    }


    public function getDateWiseRows(array $month):string
    {
        $dayOfWeek = 0;
        $rows = '<tr>';
            
        foreach ($month as $date) {
            $weekStartFrom = 0;
            if ($date->day == 1) {
                $dt = $this->getDateComponents($date);
                $weekStartFrom = intval($dt->format('N'));
            }
            
            if ($weekStartFrom > 0 && $weekStartFrom <7) {
                $rows .= sprintf('<td colspan="%s" class="not-month">&nbsp;</td>', $weekStartFrom);
                $dayOfWeek += $weekStartFrom;
            }
            
            if ($dayOfWeek == 7) {
                $rows .= '</tr>';
                $rows .= '<tr>';
                $dayOfWeek = 0;
            }

            $rows .= sprintf('<td class="day"><span class="%s">%s=%s</span></td>', $this->checkTodayDate($date), $date->day, $date->score);
            
            $dayOfWeek++;
        }

        if ($dayOfWeek != 7) {
            $remainingDays = 7 - $dayOfWeek;
            $rows .= sprintf('<td colspan="%s" class="not-month">&nbsp;</td>', $remainingDays);
        }
        
        $rows .= '</tr>';
        return $rows;
    }


    public function formatCalendarWithHtml(Collection $dates):string
    {
        $daysOfWeekRow = $this->getDayOfWeeksRow($this->getDaysOfWeek());
        $monthWiseDates = $this->formatCalendarMonthWise($dates);
        
        $calendar = '';
        foreach ($monthWiseDates as $key=>$month) {
            $calendar .= '<div class="table-wrapper">';
            $calendar .= '<table class="calendar">';

            $calendar .= sprintf('<caption>%s</caption>', $this->getMonthName($key));
            $calendar .= $daysOfWeekRow;
            $calendar .= $this->getDateWiseRows($month);
           
            $calendar .= '</table>';
            $calendar .= '</div>';
        }


        return $calendar;
    }
}
