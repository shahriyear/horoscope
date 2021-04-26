<?php

namespace App\Traits;

use DateTime;
use Illuminate\Database\Eloquent\Collection;

trait CalenderHtmlTrait
{
    public function getDaysOfWeek(): array
    {
        return ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'];
    }

    public function getMonthName(int $month): string
    {
        $dt = DateTime::createFromFormat('!m', $month);

        return $dt->format('F');
    }

    public function getDateComponents($date = null): DateTime
    {
        if (null == $date) {
            return new DateTime();
        }

        return new DateTime($date->year.'-'.$date->month.'-'.$date->day);
    }

    public function getDayOfWeeksRow(array $weekNames): string
    {
        $row = '<tr>';
        foreach ($weekNames as $weekName) {
            $row .= sprintf('<th class="header">%s</th>', $weekName);
        }
        $row .= '</tr>';

        return $row;
    }

    public function getDateWiseRows(array $month): string
    {
        $dayOfWeek = 0;
        $rows = '<tr>';

        foreach ($month as $date) {
            $weekStartFrom = 0;
            if (1 == $date->day) {
                $dt = $this->getDateComponents($date);
                $weekStartFrom = intval($dt->format('N'));
            }

            if ($weekStartFrom > 0 && $weekStartFrom < 7) {
                $rows .= sprintf('<td colspan="%s" class="not-month">&nbsp;</td>', $weekStartFrom);
                $dayOfWeek += $weekStartFrom;
            }

            if (7 == $dayOfWeek) {
                $rows .= '</tr>';
                $rows .= '<tr>';
                $dayOfWeek = 0;
            }

            $rows .= sprintf('<td class="day score-%s">%s</td>', $date->score, $date->day);

            ++$dayOfWeek;
        }

        if (7 != $dayOfWeek) {
            $remainingDays = 7 - $dayOfWeek;
            $rows .= sprintf('<td colspan="%s" class="not-month">&nbsp;</td>', $remainingDays);
        }

        $rows .= '</tr>';

        return $rows;
    }

    public function formatCalendarWithHtml(Collection $dates): string
    {
        $daysOfWeekRow = $this->getDayOfWeeksRow($this->getDaysOfWeek());
        $monthWiseDates = $this->formatCalendarMonthWise($dates);

        $calendar = '';
        foreach ($monthWiseDates as $key => $month) {
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
