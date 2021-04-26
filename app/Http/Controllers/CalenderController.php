<?php

namespace App\Http\Controllers;

use App\Models\Calender;
use App\Models\Zodiac;
use App\Traits\CalenderHtmlTrait;
use App\Traits\CalenderTrait;
use DateTime;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    use CalenderTrait;
    use CalenderHtmlTrait;

    protected $data;

    public function __construct()
    {
        $this->data['zodiacs'] = Zodiac::all();
        $this->data['year'] = (new DateTime())->format('Y');
    }

    public function index()
    {
        return view('calender', $this->data);
    }

    public function search(Request $request)
    {
        $request->validate([
            'year' => 'required|max:4|min:4',
        ]);

        $dates = Calender::where('year', $request->year)->where('zodiac_id', $request->zodiac_id);
        if (0 == $dates->count()) {
            $datesData = $this->buildCalender($request->year, $this->data['zodiacs']);
            abort_if(!Calender::insert($datesData), 500);
        }

        $this->data['year'] = $request->year;
        $this->data['zodiacName'] = Zodiac::find($request->zodiac_id)->name;
        $this->data['bestMonth'] = $this->getBestMonthByYearAndZodiacId($request->zodiac_id, $request->year);
        $this->data['bestZodiac'] = $this->getBestZodiacByYear($request->year);
        $this->data['html'] = $this->formatCalendarWithHtml($dates->get());

        return view('calender', $this->data);
    }
}
