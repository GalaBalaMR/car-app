<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::with('parts')->get();

        return response()->json($cars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        $request->validated($request->all());

        $car = Car::create([
            'name' => $request->name,
            'registration_number' => $request->registration_number,
            'is_registered' => $request->is_registered,
        ]);

        return response()->json([
            'car' => $car,
            'message' => "Car was added...",
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
    public function update(CarRequest $request, Car $car)
    {
        $request->validated($request->all());

        $car->update([
            'name' => $request->name,
            'registration_number' => $request->registration_number,
            'is_registered' => $request->is_registered,
        ]);

        return response()->json([
            'car' => $car,
            'message' => "Car was updated...",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json('Car was deleted');
    }   
}