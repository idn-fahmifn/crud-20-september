<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use App\Models\{Item, Location};

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::paginate(5);
        $locations = Location::latest()->get();
        return view('items.index', compact('items', 'locations'));
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
            'item' => ['required', 'string', 'min:3', 'max:30'],
            'brand' => ['required', 'string', 'min:3', 'max:30'],
            'location' => ['required', 'integer', Rule::exists('locations', 'id')],
            'stock' => ['required', 'integer', 'min:0', 'max:999'],
            'images' => ['required', 'image', 'mimes:png,jpg,jpeg,svg'],
            'desc' => ['required']
        ]);

        $simpan = [
            'uuid' => Str::uuid(),
            'item_name' => $request->item,
            'brand' => $request->brand,
            'stock' => $request->stock,
            'desc' => $request->desc,
            'location_id' => $request->location,
        ];

        $gambar = $request->file('images');
        $format = $gambar->getClientOriginalExtension();
        $nama = 'items_'.now()->format('Ymdhis').'_'.uniqid().'.'.$format; //items_20260904_abcd.png
        
        // simpen ke database
        $simpan['photo'] = $nama;
        $gambar->storeAs('items', $nama, 'public');

        Item::create($simpan);

        return back()->with('success', 'Item has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show($param)
    {
        $item = Item::where('uuid', $param)->firstOrFail();
        $locations = Location::all();
        return view('items.detail', compact('item', 'locations')); 
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
