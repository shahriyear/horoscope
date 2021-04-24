<?php

namespace App\Http\Controllers;

use App\Models\Calender;
use App\Models\Zodiac;
use App\Traits\CalenderHtmlTrait;
use App\Traits\CalenderTrait;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    use CalenderTrait,CalenderHtmlTrait;

    protected $data;

    public function __construct()
    {
        $this->data['zodiacs'] = Zodiac::all();
        $this->data['year'] = (new \DateTime())->format('Y');
    }

    public function index()
    {
        return view('calender', $this->data);
    }

    public function search(Request $request)
    {
        $dates = Calender::where('year', $request->year)->where('zodiac_id', $request->zodiac_id);
        if ($dates->count() == 0) {
            $datesData = $this->buildCalender($request->year, $this->data['zodiacs']);
            Calender::insert($datesData);
        }


        $bestMonth = $this->getBestMonthByYearAndZodiacId($request->zodiac_id, $request->year);
        $bestZodiac = $this->getBestZodiacByYear($request->year);

        $this->data['year'] = $request->year;
        $this->data['zodiacName'] = Zodiac::find($request->zodiac_id)->name;
        $this->data['bestMonth'] = $bestMonth;
        $this->data['bestZodiac'] = $bestZodiac;
        $this->data['html'] = $this->formatCalendarWithHtml($dates->get());
        return view('calender', $this->data);
    }
}
