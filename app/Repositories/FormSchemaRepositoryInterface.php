<?php

namespace App\Repositories;

use App\Models\FormSchema;
use App\Models\Workspace;
use Illuminate\Support\Collection;

interface FormSchemaRepositoryInterface
{
    public function create(array $data): FormSchema;
    public function checkIsOwner(string $data1, string $data2);
    public function update(array $data, $id);
    // public function findFormSchema($id);

}
