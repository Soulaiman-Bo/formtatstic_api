<?php

namespace App\Repositories;

use App\Models\Workspace;
use Illuminate\Support\Collection;

class WorkspaceRepository implements WorkspaceRepositoryInterface
{
    public function findByOwner(string $ownerId): Collection
    {
        return Workspace::where('owner_id', $ownerId)->get();
    }

    public function find(string $id, string $ownerId): ?Workspace
    {
        return Workspace::where('_id', $id)->where('owner_id', $ownerId)->first();
    }

    public function store(array $data, string $ownerId): Workspace
    {
        $workspace = new Workspace($data);
        $workspace->owner_id = $ownerId;
        $workspace->save();

        return $workspace;
    }

    public function update(Workspace $workspace, array $data): Workspace
    {
        $workspace->update($data);
        return $workspace;
    }

    public function delete(Workspace $workspace): void
    {
        $workspace->delete();
    }
}
