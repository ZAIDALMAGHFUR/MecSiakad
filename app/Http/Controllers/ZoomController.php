<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \MacsiDigital\Zoom\Facades\Zoom;

class ZoomController extends Controller
{
  public function index()
  {
    $meeting = Zoom::user()->find('almaghfurzaid@gmail.com')->meetings()->where('type', 'scheduled')->get()->toArray();
    // return $meeting;
    return view('dashboard.zoom.index', $meeting);
  }

  public function create()
  {
    return view('dashboard.zoom.create');
  }

  public function save(Request $request)
  {
    /**
     *
     * Membuat Meeting Baru
     */
    $topic = $request->input('topic');
    $duration = $request->input('duration');
    $start_time = $request->input('start_time');

    $meetings = Zoom::user()->find('almaghfurzaid@gmail.com')->meetings()->create([
      'topic' => $topic,
      'duration' => $duration, // In minutes, optional
      'start_time' => new Carbon($start_time),
      'timezone' => 'Asia/Jakarta',
    ]);
    // return response()->json(['success' => 'Zoom successfully added']);
    return redirect()->route('zoom')->with([
      'success' => 'Zoom berhasil ditambahkan',
      'alert-type' => 'success'
    ]);
    // return view('dashboard.zoom.index', $meetings);
  }


  public function delete($id)
  {
    $meeting = Zoom::meeting()->find($id)->delete();
    return redirect()->route('zoom', $meeting)->with([
      'success' => 'Zoom successfully deleted!',
      'alert-type' => 'success'
    ]);
  }
}
