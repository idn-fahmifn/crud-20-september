<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $locations = Location::withCount('items')->paginate(5);
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location' => ['string', 'required', 'min:3', 'max:30'], 
            'size' => ['required', 'in:small,medium,large'],
            'notes' => ['nullable']
        ]);

        $simpan = [ 
            'uuid' => Str::uuid(),
            'location_name' => $request->location,
            'size' => $request->size,
            'notes' => $request->notes,
        ];

        Location::create($simpan);

        return back()->with('success', 'Location Has Been Created');
        // return $request;

    }

    /**
     * Display the specified resource.
     */
    public function show($param)
    {
        // $data = Location::find(); //ini harus pake ID 
        $data = Location::where('uuid', $param)->firstOrFail();
        return view('locations.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $param)
    {
        $request->validate([
            'location' => ['string', 'required', 'min:3', 'max:30'], 
            'size' => ['required', 'in:small,medium,large'],
            'notes' => ['nullable']
        ]);

        $simpan = [ 
            'uuid' => Str::uuid(),
            'location_name' => $request->location,
            'size' => $request->size,
            'notes' => $request->notes,
        ];

        $data = Location::where('uuid', $param)->first();
        $data->update($simpan);

        return redirect()->route('locations.show', $data->uuid)->with('success', 'Location Has Been Edited');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($param)
    {
        $data = Location::where('uuid', $param)->first();
        $data->delete();
        return redirect()->route('locations.index')
        ->with('success', 'Location Has Been Deleted');
    }
}
