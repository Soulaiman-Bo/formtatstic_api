<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreworkspaceRequest;
use App\Http\Resources\WorkspaceResource;
use App\Models\Workspace;
use App\Repositories\WorkspaceRepositoryInterface;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    protected $workspaceRepository;

    public function __construct(WorkspaceRepositoryInterface $workspaceRepository)
    {
        $this->workspaceRepository = $workspaceRepository;
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $workspaces = $this->workspaceRepository->findByOwner($userId);
        return response()->json(WorkspaceResource::collection($workspaces));
    }

    public function store(StoreworkspaceRequest $request)
    {
        $workspaceData = $request->validated();
        $workspace = $this->workspaceRepository->store($workspaceData, $request->user()->id);
        return response()->json(new WorkspaceResource($workspace), 201);
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $workspace = $this->workspaceRepository->find($id, $userId);

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        return response()->json(new WorkspaceResource($workspace));
    }

    public function update(StoreworkspaceRequest $request, $id)
    {
        $userId = $request->user()->id;
        $workspace = $this->workspaceRepository->find($id, $userId);

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        $updatedWorkspace = $this->workspaceRepository->update($workspace, $request->validated());
        return response()->json(new WorkspaceResource($updatedWorkspace));
    }

    public function destroy(Request $request, $id)
    {
        $userId = $request->user()->id;
        $workspace = $this->workspaceRepository->find($id, $userId);

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found'], 404);
        }

        $this->workspaceRepository->delete($workspace);
        return response()->json(['message' => 'Workspace deleted']);
    }

    
}
