<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreformRequest;
use App\Models\form;
use App\Models\workspace;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $workspaceId)
    {
        $userId = $request->user()->id;

        $workspace = workspace::where('id', $workspaceId)
            ->where('owner_id', $userId)
            ->first();

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        $forms = $workspace->forms;

        return response()->json($forms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreformRequest $request, $workspaceId)
    {
        $userId = $request->user()->id;

        $workspace = workspace::where('id', $workspaceId)
            ->where('owner_id', $userId)
            ->first();

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        $validatedData = $request->validated();
        $form = new form($validatedData);
        $form->workspace_id = $workspaceId;
        $form->save();

        return response()->json($form, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
