<?php

namespace App\Repositories;

use App\Models\Workspace;
use Illuminate\Support\Collection;

interface WorkspaceRepositoryInterface
{
    public function findByOwner(string $ownerId);
    public function find(string $id, string $ownerId);
    public function store(array $data, string $ownerId);
    public function update(Workspace $workspace, array $data);
    public function delete(Workspace $workspace);
}
