<?php

namespace App\Http\Controllers;
use App\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Calendar;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calendar()
    {
        return view('calendar.calendar');
    }

    public function calendar_holiday()
    {
        return Calendar::where('status',1)->get();
    }

    public function calendar_delete($event_id){
        Calendar::where('event_id',$event_id)->delete();
    }

    public function calendar_save(Request $request){
        $calendar = new Calendar();
        $calendar->event_id = $request->get('event_id');
        $calendar->title = $request->get('title');
        $calendar->start = $request->get('start');

        $enddate = date_create(date('Y-m-d',strtotime($request->get('end'))));
        date_add($enddate, date_interval_create_from_date_string('1days'));
        $end_date = date_format($enddate, 'Y-m-d');

        $calendar->end = $end_date;
        $calendar->backgroundColor = $request->get('backgroundColor');
        $calendar->borderColor = $request->get('borderColor');
        $calendar->status = 1;
        $calendar->save();
    }

    public function calendar_update(Request $request)
    {
        $request_start = $request->get('start');
        $calendar = Calendar::where('event_id',$request->get('event_id'))->first();
        $difference = strtotime($calendar->end) - strtotime($calendar->start);
        $day_range = floor($difference / (60 * 60 * 24));
        $end = date_create($request_start);
        date_add($end, date_interval_create_from_date_string($day_range.'days'));
        $day_end = date_format($end, 'Y-m-d');
        if($request->get('type') == 'drop') {
            return Calendar::where('event_id', $request->get('event_id'))
                ->update(['start' => $request_start,'end' => $day_end]);
        }
        else
            return Calendar::where('event_id',$request->get('event_id'))
                ->update(['end' => $request->get('end')]);
    }

}