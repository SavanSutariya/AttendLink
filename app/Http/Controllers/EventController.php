<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;
use App\Models\User;

class EventController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function create()
{
    return view('Event.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'details' => 'required|string',
        'venue' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'start_datetime' => 'required|date',
        'end_datetime' => 'required|date|after:start_datetime',
    ]);
    $user = Auth::user();

    // Handle file upload
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('thumbnails', $fileName, 'public');
    }

    // Create event with uploaded file path and other fields
    $event = Event::create([
        'title' => $request->input('title'),
        'thumbnail' => $filePath, // Save the file path
        'details' => $request->input('details'),
        'venue' => $request->input('venue'),
        'city' => $request->input('city'),
        'start_datetime' => $request->input('start_datetime'),
        'end_datetime' => $request->input('end_datetime'),
        'user_id' => $user->id,
    ]);

    return redirect()->route('events.show', $event->id)
                    ->with('success', 'Event created successfully.');
}

public function rsvp(Request $request, Event $event)
{
    // Assuming you have a 'registrations' table to store RSVPs

    // Validate the request data
    $request->validate([
        // Add any validation rules as needed
    ]);

    // Check if the user has already RSVP'd for this event
    $existingRegistration = Registration::where('userId', Auth::id())
                                        ->where('EventId', $event->id)
                                        ->first();

    if ($existingRegistration) {
        return redirect()->route('events.show', $event->id)
                         ->with('error', 'You have already RSVP\'d for this event.');
    }

    // Create a new RSVP entry in the 'registrations' table
    Registration::create([
        'userId' => Auth::id(),
        'EventId' => $event->id,
        'regTime' => now(),
    ]);

    return redirect()->route('events.show', $event->id)
                     ->with('success', 'You have successfully RSVP\'d for this event.');
}

// EventController.php

public function show($eventId)
{
    $event = Event::find($eventId);
    $user = auth()->user();
    $isRegistered = $user ? $event->registrations->contains('userId', $user->id) : false;

    return view('event.show', compact('event', 'isRegistered'));
}
public function showAttendees($eventId)
{
    $event = Event::find($eventId);

    // Check if the authenticated user is the creator of the event
    if ($event->user_id !== auth()->id()) {
        abort(403, 'You are not authorized to view this page.');
    }
    // Get all the attendees for this event
    
    $attendees = User::join('registration', 'users.id', '=', 'registration.userId')
                    ->where('registration.eventId', $eventId)
                    ->get();

    return view('event.attendees', compact('event', 'attendees'));
}

}
