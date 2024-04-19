<?php

namespace App\Repositories;

use App\Models\Form;
use App\Models\FormSchema;
use App\Models\Workspace;
use Illuminate\Support\Collection;

class FormSchemaRepository  implements FormSchemaRepositoryInterface
{


    public function create(array $data): FormSchema
    {
        return FormSchema::create($data);
    }


    public function checkIsOwner(string $formId, string $userId)
    {
        $isOwner = Form::where('_id', $formId)->where('owner_id', $userId)->exists();

        if (!$isOwner) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    public function update(array $data, $id)
    {
        $formSchema = FormSchema::find($id);
        if ($formSchema) {
            $formSchema->update($data);
            return $formSchema;
        }
        return null;
    }





    

}
