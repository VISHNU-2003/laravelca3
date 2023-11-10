<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TodoCollection(Todo::withTrashed()->where('user_id', auth()->id())->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(["user_id" => auth()->id()]);
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['Validation Error.' => $validator->errors()], 500);
        }

        $todo = Todo::create($input);

        return response()->json(['Todo' => new TodoResource($todo), 'message' => 'Todo created successfully.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $todo = Todo::withTrashed()->where('id', $id)->where('user_id', auth()->id())->first();
        if(!$todo){
            return response()->json(['message' => 'Todo not found'], 204);
        }
        return new TodoResource($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['Validation Error.' => $validator->errors()], 500);
        }

        $todo->title = $input['title'];
        if(isset($input['description'])) $todo->description = $input['description'];
        if(isset($input['completed'])) $todo->completed = $input['completed'];
        $todo->save();

        return response()->json(['Todo' => new TodoResource($todo), 'message' => 'Todo updated successfully.'], 200);
    }

    /**
     * Delete/Restore the specified resource from storage.
     */
    public function destroy($id)
    {
        $todo = Todo::withTrashed()->where('id', $id)->where('user_id', auth()->id())->first();
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 500);
        }
        $todo->trashed() ? $todo->restore() : $todo->delete();
        return response()->json(['message' => $todo->trashed() ? 'Todo deleted successfully.' : 'Todo restored successfully.'], 200);
    }
}
