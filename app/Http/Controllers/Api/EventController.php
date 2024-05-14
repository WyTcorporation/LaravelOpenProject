<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Traids\CanLoadRelationships;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    use CanLoadRelationships;

    private array $relations = ['user', 'attendees', 'attendees.user'];

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->middleware('throttle:api')
            ->only(['store', 'update', 'destroy']);
        $this->authorizeResource(Event::class,'event');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = $this->loadRelationships(Event::query());

//        $relations =['user', 'attendees','attendees.user'];
//        $query = Event::query();
//        foreach ($relations as $relation){
//            $query->when(
//                $this->shouldIncludeRelation($relation),
//                fn($q) => $q->with($relation)
//            );
//        }

        return EventResource::collection(
//            Event::with(['user', 'attendees'])->paginate()
            $query->latest()->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = Event::create([
            ...$request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time'
            ]),
            'user_id' => $request->user()->id
        ]);
//        $event->load('user');
//        $event->load('attendees');
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
//        $event->load('user');
//        $event->load('attendees');
//        return new EventResource($event);
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
//        if (Gate::denies('update-event', $event))
//            abort(403, 'You are not authorized to update this event.(denies)');
//
//        if (!Gate::allows('update-event', $event))
//            abort(403, 'You are not authorized to update this event.(allows)');

//        $this->authorize('update-event', $event);


        $event->update(
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'sometimes|date',
                'end_time' => 'sometimes|date|after:start_time'
            ])
        );
//        $event->load('user');
//        $event->load('attendees');
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response([
            'message' => 'Invalid credentials'
        ], 204);
//        return response()->json([
//            'message' => 'Event deleted successfully'
//        ]);
    }
}
