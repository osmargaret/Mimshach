<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $cities = ['All Cities', ...Event::distinct()->pluck('location')->filter()->sort()->values()->toArray()];

        $filters = [
            [
                'type' => 'date',
                'name' => 'date_from',
                'placeholder' => 'Event From',
            ],
            [
                'type' => 'date',
                'name' => 'date_to',
                'placeholder' => 'Event To',
            ],
            [
                'type' => 'date',
                'name' => 'specific_date',
                'placeholder' => 'Specific Date',
            ],
            [
                'type' => 'search',
                'name' => 'search',
                'placeholder' => 'Search events...',
            ],
            [
                'type' => 'select',
                'name' => 'city',
                'label' => 'City',
                'options' => $cities,
            ],
        ];

        $query = Event::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->city && $request->city !== 'All Cities') {
            $query->where('location', $request->city);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }
        if ($request->filled('specific_date')) {
            $query->whereDate('date', $request->specific_date);
        }

        $events = $query->orderBy('created_at', 'desc')->paginate(8);

        return view('guest.events.index', compact('events', 'filters'));
    }

    public function show(Event $event)
    {
        return view('guest.events.event', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'date_of_birth' => 'required|date',
        ]);

        $exists = EventRegistration::query()
            ->where('event_id', $event->id)
            ->where('email', $validated['email'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'You are already registered for this event.',
            ], 422);
        }

        EventRegistration::create([
            'event_id' => $event->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'date_of_birth' => $validated['date_of_birth'],
        ]);

        return response()->json([
            'message' => 'You have successfully registered for the event!',
        ]);
    }
}
