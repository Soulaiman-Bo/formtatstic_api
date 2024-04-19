<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormSchemaRequest;
use App\Models\Form;
use App\Models\FormSchema;
use App\Repositories\FormSchemaRepositoryInterface;
use Illuminate\Http\Request;

class FormSchemaController extends Controller
{
    protected $repository;


    public function __construct(FormSchemaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(FormSchemaRequest $request)
    {

        $formId = $request->input('form_id');
        $userId = $request->user()->id;

        $this->repository->checkIsOwner($formId, $userId);

        $formSchema = $this->repository->create($request->validated());

        return response()->json($formSchema, 201);
    }

    /**
     * Display the specified resource.
     */
    public function index(Request $request, $formId)
    {
        $form = Form::with('formschema')->find($formId);

        if (!$form) {
            return response()->json(['message' => 'Form not found'], 404);
        }

        $isOwner =  $request->user()->id === $form->owner_id;

        if (!$isOwner) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        return response()->json($form->formschema, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormSchemaRequest $request, $formId, $formSchemaId)
    {
        $formSchema =  FormSchema::with('form')->find($formSchemaId);

        if (!$formSchema) {
            return response()->json(['message' => 'Form schema not found'], 404);
        }

        if ($request->user()->id != $formSchema->form->owner_id) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        $formSchema->update($request->validated());

        return response()->json($formSchema, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormSchema $formSchema)
    {
        //
    }
}
