<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreworkspaceRequest;
use App\Http\Requests\UpdateworkspaceRequest;
use App\Http\Resources\WorkspaceResource;
use Illuminate\Http\Request;
use App\Models\Workspace;
use Validator;

class WorkspaceController extends Controller
{
    // Display a listing of the workspaces
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $workspaces = Workspace::where('owner_id', $userId)->get();
        return response()->json(WorkspaceResource::collection($workspaces));
    }

    public function store(StoreworkspaceRequest $request)
    {
        $workspaceData = $request->validated();
        $workspace = new Workspace($workspaceData);
        $workspace->owner_id = $request->user()->id;
        $workspace->save();

        return response()->json(new WorkspaceResource($workspace), 201);
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $workspace = Workspace::where('id', $id)
            ->where('owner_id', $userId)
            ->first();

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        return response()->json(new WorkspaceResource($workspace));
    }

    // Update the specified workspace
    public function update(StoreworkspaceRequest $request, $id)
    {
        $userId = $request->user()->id;
        $workspace = Workspace::where('id', $id)
            ->where('owner_id', $userId)
            ->first();

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        $workspace->update($request->validated());

        return response()->json(new WorkspaceResource($workspace));
    }


    // Remove the specified workspace
    public function destroy(Request $request, $id)
    {
        $userId = $request->user()->id;

        $workspace = Workspace::where('id', $id)
            ->where('owner_id', $userId)
            ->first();

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        $workspace->delete();

        return response()->json(['message' => 'Workspace deleted']);
    }
}
