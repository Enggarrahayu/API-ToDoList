<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoItemRequest;
use App\Http\Resources\TodoItemResource;
use App\Models\Checklist;
use App\Models\TodoItem;
use Illuminate\Http\JsonResponse;

class TodoItemController extends Controller
{
    public function index(Checklist $checklist)
    {
        return TodoItemResource::collection($checklist->todoItems);
    }

    public function store(TodoItemRequest $request, Checklist $checklist): JsonResponse
    {
        $todoItem = $checklist->todoItems()->create([
            'title' => $request->title,
            'completed' => $request->completed ?? false,
        ]);

        return response()->json([
            'message' => 'To-do item created successfully!',
            'todo_item' => new TodoItemResource($todoItem),
        ], 201);
    }
}
