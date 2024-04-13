<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreformRequest;
use App\Models\Form;
use App\Models\Workspace;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index(Request $request, $workspaceId)
    {
        $userId = $request->user()->id;

        $workspace = workspace::where('_id', $workspaceId)
            ->where('owner_id', $userId)
            ->first();

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        $forms = $workspace->forms;

        return response()->json($forms);
    }

    public function store(StoreformRequest $request)
    {
        $userId = $request->user()->id;

        $validatedData = $request->validated();

        $workspace = Workspace::where('_id', $request->workspace_id)
            ->where('owner_id', $userId)
            ->first();


        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        $validatedData = $request->validated();
        $form = new Form($validatedData);
        $form->workspace_id = $request->workspace_id;;
        $form->save();

        return response()->json($form, 201);
    }
}
