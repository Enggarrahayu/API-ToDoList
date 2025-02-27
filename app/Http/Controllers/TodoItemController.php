<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoItemRequest;
use App\Http\Resources\TodoItemResource;
use App\Models\Checklist;
use App\Models\TodoItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function show(TodoItem $todoItem)
    {
        return new TodoItemResource($todoItem);
    }

    public function destroy($checklistId, $todoItemId)
    {
        $todoItem = TodoItem::where('id', $todoItemId)
            ->where('checklist_id', $checklistId)
            ->first();

        if (!$todoItem) {
            return response()->json(['message' => 'Item is not found'], 404);
        }

        $todoItem->delete();

        return response()->json([
            'message' => 'Item deleted successfully'
        ], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $todoItem = TodoItem::find($id);

        if (!$todoItem) {
            return response()->json(['message' => 'Item is not found'], 404);
        }

        $todoItem->status = $request->status;
        $todoItem->save();

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $todoItem
        ], 200);
    }
}
