<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Calendar;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::get();
        $events_list = [];
        foreach ($events as $event) {
            $events_list[] = Calendar::event(
              $event->title,
              true,
              new \DateTime($event->start_date),
              new \DateTime($event->finish_date . ' +1 day')
            );
        }
        $calendar_detalis = Calendar::addEvents($events_list);
        return view('events.index', compact('calendar_detalis'));
    }

    public function addEvent(Request $request)
    {
        $this->validate($request, [
           'title' => 'required' ,
           'start_date' => 'required',
           'finish_date' => 'required',
        ]);
        Event::addEvent($request->all());
        return redirect()->back()->with('status', 'Event added successfully');
    }
}
