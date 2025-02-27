<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChecklistRequest;
use App\Http\Resources\ChecklistResource;
use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index(Request $request)
    {
        $checklists = Checklist::latest()->paginate(10); // Pagination opsional
        return ChecklistResource::collection($checklists);
    }
    public function store(ChecklistRequest $request)
    {
        $checklist = Checklist::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'completed' => $request->completed ?? false,
        ]);

        return response()->json([
            'message' => 'Checklist item created successfully!',
            'checklist' => new ChecklistResource($checklist),
        ], 201);
    }
}
