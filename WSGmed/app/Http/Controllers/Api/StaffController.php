<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Staff API",
 *     version="1.0.0",
 *     description="API for managing staff resources"
 * )
 * 
 * @OA\Tag(
 *     name="Staff",
 *     description="Operations related to staff management"
 * )
 */
class StaffController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/staff",
     *     tags={"Staff"},
     *     summary="Get all staff members",
     *     @OA\Response(
     *         response=200,
     *         description="List of all staff members",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Staff"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Staff::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/staff",
     *     tags={"Staff"},
     *     summary="Create a new staff member",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StaffCreateRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Staff member created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Staff")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:staff,email',
            'password' => 'required|min:6',
            'name' => 'required|string|max:255',
            's_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'role' => 'required|string|in:internist,specialist,rehabilitator,nurse,doctor',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $staff = Staff::create($validatedData);

        return response()->json($staff, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/staff/{id}",
     *     tags={"Staff"},
     *     summary="Get a specific staff member",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the staff member",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details of the staff member",
     *         @OA\JsonContent(ref="#/components/schemas/Staff")
     *     )
     * )
     */
    public function show(Staff $staff)
    {
        return response()->json($staff, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/staff/{id}",
     *     tags={"Staff"},
     *     summary="Update a specific staff member",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the staff member",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StaffUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Staff member updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Staff")
     *     )
     * )
     */
    public function update(Request $request, Staff $staff)
    {
        $validatedData = $request->validate([
            'email' => 'sometimes|email|unique:staff,email,' . $staff->id,
            'password' => 'sometimes|min:6',
            'name' => 'sometimes|string|max:255',
            's_name' => 'sometimes|string|max:255',
            'date_of_birth' => 'sometimes|date',
            'role' => 'sometimes|string|in:internist,specialist,rehabilitator,nurse,doctor',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $staff->update($validatedData);

        return response()->json($staff, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/staff/{id}",
     *     tags={"Staff"},
     *     summary="Delete a specific staff member",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the staff member",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Staff member deleted successfully"
     *     )
     * )
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return response()->json(null, 204);
    }
}