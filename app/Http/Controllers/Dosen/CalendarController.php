<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function getDosenEvent(){
        if(request()->ajax()){
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $events = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)
                    ->get(['id','title','start', 'end']);
            return response()->json($events);
        }
        return view('dashboard.dosen.calenderacademic.index');
         
    }
}
