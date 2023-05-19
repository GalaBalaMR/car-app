<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Part;
use Illuminate\Http\Request;
use App\Http\Requests\PartRequest;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $part = Part::all();

        return response()->json($part);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartRequest $request)
    {
        $request->validated($request->all());

        $part = Part::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'car_id' => $request->car_id,
        ]);

        return response()->json([
            'part' => $part,
            'message' => "Part was added...",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartRequest $request, Part $part)
    {
        $request->validated($request->all());

        $part->update([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'car_id' => $request->car_id,
        ]);

        return response()->json([
            'part' => $part,
            'message' => "Part was updated...",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part $part)
    {
        $part->delete();

        return response()->json('Part was deleted');
    }
}
