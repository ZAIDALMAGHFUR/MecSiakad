<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FullCalendarController extends Controller
{
    public function getEvent()
    {
        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $events = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id', 'title', 'start', 'end']);
    
            foreach ($events as $booking) {
                $color = null;
                if ($booking->title == 'uts') {
                    $color = '#924ACE';
                }else if ($booking->title == 'uas') {
                    $color = '#68B01A';
                } else if ($booking->title == 'libur') {
                    $color = '#FF0000';
                } else if ($booking->title == 'belajar') {
                    $color = '#1A73E8';
                }
    
                $booking->color = $color;
            }
            return response()->json($events);
        }
    
        return view('dashboard.master.calenderacademic.index');
    }
    
    public function createEvent(Request $request)
    {
        $data = $request->except('_token');
        $event = Event::create($data);
    
        $color = null;
    
        if ($event->title == 'uts') {
            $color = '#924ACE';
        } else if ($event->title == 'Test 1') {
            $color = '#68B01A';
        } else if ($event->title == 'uas') {
            $color = '#68B01A';
        } else if ($event->title == 'libur') {
            $color = '#FF0000';
        }
    
        $event->color = $color;
    
        return response()->json($event);
    }
    
    public function deleteEvent(Request $request){
        $event = Event::find($request->id);
        return $event->delete();
    }



    // public function index()
    // {
    //     $events = array();
    //     $bookings = Event::all();
    //     foreach($bookings as $booking) {
    //         $color = null;
    //         if($booking->title == 'Test') {
    //             $color = '#924ACE';
    //         }
    //         if($booking->title == 'Test 1') {
    //             $color = '#68B01A';
    //         }

    //         $events[] = [
    //             'id'   => $booking->id,
    //             'title' => $booking->title,
    //             'start' => $booking->start,
    //             'end' => $booking->end,
    //             'color' => $color
    //         ];
    //     }
    //     return view('dashboard.master.calenderacademic.index', ['events' => $events]);
    // }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string'
    //     ]);

    //     $booking = Event::create([
    //         'title' => $request->title,
    //         'start' => $request->start,
    //         'end' => $request->end,
    //     ]);

    //     $color = null;

    //     if($booking->title == 'uas') {
    //         $color = '#924ACE';
    //     } else if($booking->title == 'uts') {
    //         $color = '#68B01A';
    //     } else if($booking->title == 'libur') {
    //         $color = '#FF0000';
    //     } 

    //     return response()->json([
    //         'id' => $booking->id,
    //         'start' => $booking->start,
    //         'end' => $booking->end,
    //         'title' => $booking->title,
    //         'color' => $color ? $color: '',

    //     ]);
        
    // }
    // public function update(Request $request ,$id)
    // {
    //     $booking = Event::find($id);
    //     if(! $booking) {
    //         return response()->json([
    //             'error' => 'Unable to locate the event'
    //         ], 404);
    //     }
    //     $booking->update([
    //         'start' => $request->start,
    //         'end' => $request->end,
    //     ]);
    //     return response()->json('Event updated');
    // }
    // public function destroy($id)
    // {
    //     $booking = Event::find($id);
    //     if(! $booking) {
    //         return response()->json([
    //             'error' => 'Unable to locate the event'
    //         ], 404);
    //     }
    //     $booking->delete();
    //     return response()->json('Event deleted');
    // }
}
