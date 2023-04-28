<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarAcademicController extends Controller
{
    public function getMahasiswaEvent(){
        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $events = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id', 'title', 'start', 'end']);
    
            foreach ($events as $booking) {
                $color = null;
                if ($booking->title == 'uts') {
                    $color = '#924ACE';
                } else if ($booking->title == 'ujian') {
                    $color = '#1A73E8';
                } else if ($booking->title == 'uas') {
                    $color = '#68B01A';
                } else if ($booking->title == 'libur') {
                    $color = '#FF0000';
                }
    
                $booking->color = $color;
            }
            return response()->json($events);
        }
        return view('dashboard.mahasiswa.calenderacademic.index');
         
    }
}
