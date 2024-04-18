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

    public function store(StoreformRequest $request, $workspaceId)
    {
        $userId = $request->user()->id;

        $workspace = Workspace::where('_id', $workspaceId)
            ->where('owner_id', $userId)
            ->first();

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        $form = new Form();
        $form->workspace_id = $request->workspace_id;
        $form->name = $request->name;
        $form->description = $request->description;
        $form->owner_id = $request->owner_id;
        $form->published = false;
        $form->submittions = 0;
        $form->visits = 0;
        $form->fields = json_encode([]);
        $form->save();

        return response()->json($form, 201);
    }

    public function show(Request $request, $workspaceId, $formId)
    {
        $userId = $request->user()->id;

        $workspace = Workspace::where('_id', $workspaceId)
            ->where('owner_id', $userId)
            ->first();

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        $form = $workspace->forms()->where('_id', $formId)->first();

        if (!$form) {
            return response()->json(['message' => 'Form not found'], 404);
        }

        return response()->json($form);
    }
}
