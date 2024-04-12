<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreworkspaceRequest;
use App\Http\Resources\WorkspaceResource;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $workspaces = Workspace::where('owner_id', $userId)->get();
        return response()->json(WorkspaceResource::collection($workspaces));
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
    public function store(StoreworkspaceRequest $request)
    {
        $workspaceData = $request->validated();
        $workspace = new Workspace($workspaceData);
        $workspace->owner_id = $request->user()->id;
        $workspace->save();

        return response()->json(new WorkspaceResource($workspace), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspace $workspace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workspace $workspace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspace $workspace)
    {
        //
    }
}
