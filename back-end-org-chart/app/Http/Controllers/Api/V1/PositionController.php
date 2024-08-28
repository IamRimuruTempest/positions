<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePositionRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::with('supervisor')->latest()->get();
        return PositionResource::collection($positions);
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
    public function store(StorePositionRequest $request)
    {
        $position = Position::create($request->validated());
        return PositionResource::make($position);
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {

        // return PositionResource::make($position->load('supervisor'));

        $position = Position::with('supervisor')
            ->where('report_to', $position->id)
            ->get();


        // return response()->json($position);

        return PositionResource::collection($position);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'position' => 'sometimes|required|string|unique:positions,position,' . $position->id,
            'reports_to' => 'nullable|exists:positions,id'
        ]);

        $position->update($validated);
        return PositionResource::make($position);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return response()->noContent();
    }
}
