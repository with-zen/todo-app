<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class TodoController extends Controller
{
     /**
     * Display a listing of todos.
     *
     * @return \Illuminate\Http\Response
     */

         /**
     * @OA\Get(
     *     path="/api/todos",
     *     summary="Get all Todos",
     *     tags={"Todos"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of todos",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function index()
    {
        try {
            $todos = Todo::all();
            return response()->json($todos);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching todos.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created todo in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Post(
     *     path="/api/todos",
     *     summary="Create a new Todo",
     *     tags={"Todos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(property="title", type="string", example="New Todo Task"),
     *             @OA\Property(property="description", type="string", example="Description of the task"),
     *             @OA\Property(property="completed", type="boolean", example=false)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Todo created successfully",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Validation failed")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'completed' => 'boolean',
            ]);

            $todo = Todo::create($validated);

            return response()->json($todo, 201);  // Return created Todo
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while creating the todo.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified todo.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    /**
 * @OA\Get(
 *     path="/api/todos/{id}",
 *     summary="Get a Todo by ID",
 *     tags={"Todos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the Todo to retrieve",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Todo found",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Todo not found"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error"
 *     )
 * )
 */
    public function show($id)
    {
        try {
            $todo = Todo::findOrFail($id);
            return response()->json($todo);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Todo not found.',
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Update the specified todo in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
       /**
     * @OA\Put(
     *     path="/api/todos/{id}",
     *     summary="Update an existing Todo",
     *     tags={"Todos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(property="title", type="string", example="Updated Todo Task"),
     *             @OA\Property(property="description", type="string", example="Updated description of the task"),
     *             @OA\Property(property="completed", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Todo updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Todo not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Validation failed")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $todo = Todo::findOrFail($id);

            // Validate the input
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'completed' => 'boolean',
            ]);

            // Update the todo item with validated data
            $todo->update($validated);

            return response()->json($todo);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while updating the todo.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified todo from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *     path="/api/todos/{id}",
     *     summary="Delete an existing Todo",
     *     tags={"Todos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Todo deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Todo not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            $todo = Todo::findOrFail($id);
            $todo->delete();
            return response()->json(null, 204);  // No Content after successful deletion
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while deleting the todo.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
