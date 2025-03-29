<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\EventRegistrationModel;
use App\Models\PermissionRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        // Check Event permission
        $PermissionEvent = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event');
        if(empty($PermissionEvent)){
            abort(404);
        }

        $query = EventRegistrationModel::with('event');

        // Handle search
        if(request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('parent_name', 'like', "%{$search}%")
                  ->orWhereHas('event', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $registrations = $query->latest()->paginate(10);
        return view('users.event', compact('registrations'));
    }

    public function master()
    {
        // Check Event_master permission
        $PermissionEventMaster = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event_master');
        if(empty($PermissionEventMaster)){
            abort(404);
        }

        $query = EventModel::query();

        // Handle search
        if(request('search')) {
            $search = request('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $events = $query->latest()->paginate(10);
        return view('users.event-master', compact('events'));
    }

    public function storeMaster(Request $request)
    {
        // Check Event_master permission
        $PermissionEventMaster = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event_master');
        if(empty($PermissionEventMaster)){
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date'
        ]);

        EventModel::create($validated);

        return redirect()->route('event.master')->with('success', 'Event berhasil ditambahkan');
    }

    public function destroyMaster($id)
    {
        // Check Event_master permission
        $PermissionEventMaster = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event_master');
        if(empty($PermissionEventMaster)){
            abort(404);
        }

        $event = EventModel::findOrFail($id);
        $event->delete();

        return redirect()->route('event.master')->with('success', 'Event berhasil dihapus');
    }

    public function register(Request $request)
    {
        // Check Event permission
        $PermissionEvent = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Event');
        if(empty($PermissionEvent)){
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'phone' => 'required|string|max:15',
            'need_socks' => 'nullable|boolean',
            'event_id' => 'required|exists:events,id',
            'parent_name' => 'required|string|max:255',
            'address' => 'required|string',
            'social_media' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'source_info' => 'required|string'
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('event_payments', 'public');
            $validated['payment_proof'] = $path;
        }

        // Set need_socks value
        $need_socks = $request->has('need_socks') ? true : false;

        $eventRegistration = EventRegistrationModel::create([
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'need_socks' => $need_socks,
            'event_id' => $request->event_id,
            'parent_name' => $request->parent_name,
            'address' => $request->address,
            'social_media' => $request->social_media,
            'payment_proof' => $validated['payment_proof'],
            'source_info' => $request->source_info
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran event berhasil',
            'data' => $eventRegistration
        ]);
    }
}
