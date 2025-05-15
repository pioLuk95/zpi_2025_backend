<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @group Staff Management
 * 
 * API endpoints for managing medical staff members
 * 
 * @OA\Tag(
 *     name="Staff",
 *     description="Operations related to staff management"
 * )
 */
class StaffController extends Controller
{
    /**
     * List all staff members
     * 
     * Returns a list of all registered staff members in the system.
     * 
     * @response status=200 scenario="Success" {
     *      "data": [
     *          {
     *              "id": 1,
     *              "email": "jan.kowalski@medical.com",
     *              "name": "Jan",
     *              "s_name": "Kowalski",
     *              "date_of_birth": "1985-03-15",
     *              "role": "doctor",
     *              "created_at": "2025-05-05T12:00:00Z",
     *              "updated_at": "2025-05-05T12:00:00Z"
     *          }
     *      ]
     * }
     * 
     * @OA\Get(
     *     path="/api/staff",
     *     tags={"Staff"},
     *     summary="Get all staff members",
     *     description="Returns a list of all registered staff members in the system",
     *     @OA\Response(
     *         response=200,
     *         description="List of all staff members",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="email", type="string", format="email", example="jan.kowalski@medical.com"),
     *                     @OA\Property(property="name", type="string", example="Jan"),
     *                     @OA\Property(property="s_name", type="string", example="Kowalski"),
     *                     @OA\Property(property="date_of_birth", type="string", format="date", example="1985-03-15"),
     *                     @OA\Property(property="role", type="string", example="doctor", enum={"internist", "specialist", "rehabilitator", "nurse", "doctor"}),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *                 )
     *             )
     *         )
     *     )
     * )
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $staff = Staff::all();
        
        return response()->json([
            'data' => $staff
        ], 200);
    }

    /**
     * Create a new staff member
     * 
     * Store a newly created staff member in the database.
     * 
     * @bodyParam email string required The email address of the staff member. Example: anna.nowak@medical.com
     * @bodyParam password string required The password for the staff member account (min 6 characters). Example: securepassword123
     * @bodyParam name string required The first name of the staff member. Example: Anna
     * @bodyParam s_name string required The surname of the staff member. Example: Nowak
     * @bodyParam date_of_birth date required The date of birth of the staff member in YYYY-MM-DD format. Example: 1990-07-22
     * @bodyParam role string required The role of the staff member. Must be one of: internist, specialist, rehabilitator, nurse, doctor. Example: nurse
     * 
     * @response status=201 scenario="Created" {
     *      "data": {
     *          "id": 2,
     *          "email": "anna.nowak@medical.com",
     *          "name": "Anna",
     *          "s_name": "Nowak",
     *          "date_of_birth": "1990-07-22",
     *          "role": "nurse",
     *          "created_at": "2025-05-13T14:30:00Z",
     *          "updated_at": "2025-05-13T14:30:00Z"
     *      }
     * }
     * 
     * @response status=422 scenario="Validation Error" {
     *      "message": "The given data was invalid.",
     *      "errors": {
     *          "email": [
     *              "The email has already been taken."
     *          ],
     *          "role": [
     *              "The selected role is invalid."
     *          ]
     *      }
     * }
     * 
     * @OA\Post(
     *     path="/api/staff",
     *     tags={"Staff"},
     *     summary="Create a new staff member",
     *     description="Store a newly created staff member in the database",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password", "name", "s_name", "date_of_birth", "role"},
     *             @OA\Property(property="email", type="string", format="email", example="anna.nowak@medical.com"),
     *             @OA\Property(property="password", type="string", format="password", example="securepassword123"),
     *             @OA\Property(property="name", type="string", example="Anna"),
     *             @OA\Property(property="s_name", type="string", example="Nowak"),
     *             @OA\Property(property="date_of_birth", type="string", format="date", example="1990-07-22"),
     *             @OA\Property(property="role", type="string", example="nurse", enum={"internist", "specialist", "rehabilitator", "nurse", "doctor"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Staff member created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=2),
     *                 @OA\Property(property="email", type="string", format="email", example="anna.nowak@medical.com"),
     *                 @OA\Property(property="name", type="string", example="Anna"),
     *                 @OA\Property(property="s_name", type="string", example="Nowak"),
     *                 @OA\Property(property="date_of_birth", type="string", format="date", example="1990-07-22"),
     *                 @OA\Property(property="role", type="string", example="nurse", enum={"internist", "specialist", "rehabilitator", "nurse", "doctor"}),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-13T14:30:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-13T14:30:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     type="array",
     *                     @OA\Items(type="string", example="The email has already been taken.")
     *                 ),
     *                 @OA\Property(
     *                     property="role",
     *                     type="array",
     *                     @OA\Items(type="string", example="The selected role is invalid.")
     *                 )
     *             )
     *         )
     *     )
     * )
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
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

        return response()->json([
            'data' => $staff
        ], 201);
    }

    /**
     * Get a specific staff member
     * 
     * Display the details for a specific staff member.
     *
     * @urlParam id integer required The ID of the staff member. Example: 3
     * 
     * @response status=200 scenario="Success" {
     *      "data": {
     *          "id": 3,
     *          "email": "tomasz.wisniewski@medical.com",
     *          "name": "Tomasz",
     *          "s_name": "Wiśniewski",
     *          "date_of_birth": "1978-11-30",
     *          "role": "specialist",
     *          "created_at": "2025-05-05T12:00:00Z",
     *          "updated_at": "2025-05-05T12:00:00Z"
     *      }
     * }
     * 
     * @response status=404 scenario="Not Found" {
     *      "message": "No query results for model [App\\Models\\Staff] 99"
     * }
     * 
     * @OA\Get(
     *     path="/api/staff/{id}",
     *     tags={"Staff"},
     *     summary="Get a specific staff member",
     *     description="Display the details for a specific staff member",
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
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=3),
     *                 @OA\Property(property="email", type="string", format="email", example="tomasz.wisniewski@medical.com"),
     *                 @OA\Property(property="name", type="string", example="Tomasz"),
     *                 @OA\Property(property="s_name", type="string", example="Wiśniewski"),
     *                 @OA\Property(property="date_of_birth", type="string", format="date", example="1978-11-30"),
     *                 @OA\Property(property="role", type="string", example="specialist", enum={"internist", "specialist", "rehabilitator", "nurse", "doctor"}),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-05T12:00:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Staff member not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Staff] 99")
     *         )
     *     )
     * )
     * 
     * @param Staff $staff
     * @return JsonResponse
     */
    public function show(Staff $staff): JsonResponse
    {
        return response()->json([
            'data' => $staff
        ], 200);
    }

    /**
     * Update a staff member
     * 
     * Update the details of a specific staff member.
     *
     * @urlParam id integer required The ID of the staff member. Example: 4
     * @bodyParam email string The email address of the staff member. Example: adam.zielinski@medical.com
     * @bodyParam password string The password for the staff member account (min 6 characters). Example: newpassword456
     * @bodyParam name string The first name of the staff member. Example: Adam
     * @bodyParam s_name string The surname of the staff member. Example: Zieliński
     * @bodyParam date_of_birth date The date of birth of the staff member in YYYY-MM-DD format. Example: 1982-04-12
     * @bodyParam role string The role of the staff member. Must be one of: internist, specialist, rehabilitator, nurse, doctor. Example: internist
     * 
     * @response status=200 scenario="Success" {
     *      "data": {
     *          "id": 4,
     *          "email": "adam.zielinski@medical.com",
     *          "name": "Adam",
     *          "s_name": "Zieliński",
     *          "date_of_birth": "1982-04-12",
     *          "role": "internist",
     *          "created_at": "2025-05-05T12:00:00Z",
     *          "updated_at": "2025-05-13T15:45:00Z"
     *      }
     * }
     * 
     * @response status=404 scenario="Not Found" {
     *      "message": "No query results for model [App\\Models\\Staff] 99"
     * }
     * 
     * @response status=422 scenario="Validation Error" {
     *      "message": "The given data was invalid.",
     *      "errors": {
     *          "email": [
     *              "The email has already been taken."
     *          ],
     *          "role": [
     *              "The selected role is invalid."
     *          ]
     *      }
     * }
     * 
     * @OA\Put(
     *     path="/api/staff/{id}",
     *     tags={"Staff"},
     *     summary="Update a specific staff member",
     *     description="Update the details of a specific staff member",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the staff member",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email", example="adam.zielinski@medical.com"),
     *             @OA\Property(property="password", type="string", format="password", example="newpassword456"),
     *             @OA\Property(property="name", type="string", example="Adam"),
     *             @OA\Property(property="s_name", type="string", example="Zieliński"),
     *             @OA\Property(property="date_of_birth", type="string", format="date", example="1982-04-12"),
     *             @OA\Property(property="role", type="string", example="internist", enum={"internist", "specialist", "rehabilitator", "nurse", "doctor"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Staff member updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=4),
     *                 @OA\Property(property="email", type="string", format="email", example="adam.zielinski@medical.com"),
     *                 @OA\Property(property="name", type="string", example="Adam"),
     *                 @OA\Property(property="s_name", type="string", example="Zieliński"),
     *                 @OA\Property(property="date_of_birth", type="string", format="date", example="1982-04-12"),
     *                 @OA\Property(property="role", type="string", example="internist", enum={"internist", "specialist", "rehabilitator", "nurse", "doctor"}),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-05T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-13T15:45:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Staff member not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Staff] 99")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     type="array",
     *                     @OA\Items(type="string", example="The email has already been taken.")
     *                 ),
     *                 @OA\Property(
     *                     property="role",
     *                     type="array",
     *                     @OA\Items(type="string", example="The selected role is invalid.")
     *                 )
     *             )
     *         )
     *     )
     * )
     * 
     * @param Request $request
     * @param Staff $staff
     * @return JsonResponse
     */
    public function update(Request $request, Staff $staff): JsonResponse
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

        return response()->json([
            'data' => $staff
        ], 200);
    }

    /**
     * Delete a staff member
     * 
     * Remove a specific staff member from the system.
     *
     * @urlParam id integer required The ID of the staff member. Example: 5
     * 
     * @response status=204 scenario="No Content"
     * 
     * @response status=404 scenario="Not Found" {
     *      "message": "No query results for model [App\\Models\\Staff] 99"
     * }
     * 
     * @OA\Delete(
     *     path="/api/staff/{id}",
     *     tags={"Staff"},
     *     summary="Delete a specific staff member",
     *     description="Remove a specific staff member from the system",
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
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Staff member not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Staff] 99")
     *         )
     *     )
     * )
     * 
     * @param Staff $staff
     * @return JsonResponse
     */
    public function destroy(Staff $staff): JsonResponse
    {
        $staff->delete();

        return response()->json(null, 204);
    }
}