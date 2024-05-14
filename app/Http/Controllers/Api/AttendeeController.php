<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Http\Traids\CanLoadRelationships;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    use CanLoadRelationships;

    private array $relations = ['user'];

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->middleware('throttle:api')
            ->only(['store', 'destroy']);
        $this->authorizeResource(Attendee::class,'attendee');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
//        $attendees = $event->attendees()->latest();
        $attendees = $this->loadRelationships(
            $event->attendees()->latest()
        );
        return AttendeeResource::collection(
            $attendees->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $attendee = $event->attendees()->create([
            "user_id" => 1
        ]);
        return new AttendeeResource($this->loadRelationships($attendee));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($this->loadRelationships($attendee));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Attendee $attendee)
    {
//        $this->authorize('delete-attendee', [$event, $attendee]);
        $attendee->delete();
        return response([
            'message' => 'Invalid credentials'
        ], 204);
//        return response()->json([
//            'message' => 'Event deleted successfully'
//        ]);
    }
}
