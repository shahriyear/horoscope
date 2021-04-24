<?php

namespace App\Traits;

use App\Models\Calender;
use App\Models\Zodiac;
use Illuminate\Database\Eloquent\Collection;

trait CalenderTrait
{
    public function buildCalender(int $year, Collection $zodiacs):array
    {
        $zodiacWiseYear = [];
        foreach ($zodiacs as $zodiac) {
            $preparedYear = $this->buildYear($year, $zodiac->id);
            array_push($zodiacWiseYear, ...$preparedYear);
        }

        return $zodiacWiseYear;
    }

    public function buildYear(int $year, int $zodiacId):array
    {
        $month = 1;
        $months = [];
        
        while ($month <= 12) {
            $preparedMonth = $this->buildMonth($month, $year, $zodiacId);
            array_push($months, ...$preparedMonth);
            $month++;
        }

        return $months;
    }


    public function buildMonth(int $month, int $year, int $zodiacId):array
    {
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        $numberDays = date('t', $firstDayOfMonth);
        $currentDay = 1;
        
        $calendar=[];

        while ($currentDay <= $numberDays) {
            array_push($calendar, [
                'day' => $currentDay,
                'month' => $month,
                'year' => $year,
                'score' => rand(1, 10),
                'zodiac_id'=>$zodiacId
            ]);
            $currentDay++;
        }
        return $calendar;
    }

    public function formatCalendarMonthWise(Collection $dates):array
    {
        $months = [];
        foreach ($dates as $date) {
            $months[$date->month][] = $date;
        }
        return $months;
    }

    public function getMaxValueKey($totals)
    {
        $values = array_values($totals);
        $maxValue = max($values);
        $keys = array_keys($totals, $maxValue);
        $firstValue = reset($keys);
        return $firstValue;
    }

    public function getBestMonthByYearAndZodiacId(int $zodiacId, int $year):string
    {
        $totals = Calender::where('year', $year)
        ->where('zodiac_id', $zodiacId)
        ->selectRaw("SUM(score) as total,month")
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();
        
        $month = $this->getMaxValueKey($totals);
        return $this->getMonthName($month);
    }
    
    public function getBestZodiacByYear(int $year):string
    {
        $totals =  Calender::where('year', $year)
        ->selectRaw("SUM(score) as total,zodiac_id")
        ->groupBy('zodiac_id')
        ->pluck('total', 'zodiac_id')
        ->toArray();
        $zodiacId = $this->getMaxValueKey($totals);
        return Zodiac::find($zodiacId)->name;
    }
}
