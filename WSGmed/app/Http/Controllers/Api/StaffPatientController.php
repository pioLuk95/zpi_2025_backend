<?php

namespace App\Http\Controllers\Api;

use App\Models\StaffPatient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @OA\Tag(
 *     name="Staff Patients",
 *     description="Operacje na relacjach między personelem a pacjentami"
 * )
 */
class StaffPatientController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/staff-patients",
     *     summary="Pobierz listę relacji personel-pacjent",
     *     tags={"Staff Patients"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista relacji personel-pacjent",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/StaffPatient")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(StaffPatient::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/staff-patients",
     *     summary="Dodaj nową relację personel-pacjent",
     *     tags={"Staff Patients"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"staff_id", "patient_id"},
     *             @OA\Property(property="staff_id", type="integer", example=1),
     *             @OA\Property(property="patient_id", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Relacja została dodana",
     *         @OA\JsonContent(ref="#/components/schemas/StaffPatient")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required|integer',
            'patient_id' => 'required|integer',
        ]);

        $staffPatient = StaffPatient::create($validatedData);

        return response()->json($staffPatient, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/staff-patients/{id}",
     *     summary="Pobierz szczegóły relacji personel-pacjent",
     *     tags={"Staff Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID relacji personel-pacjent"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Szczegóły relacji personel-pacjent",
     *         @OA\JsonContent(ref="#/components/schemas/StaffPatient")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Relacja nie znaleziona"
     *     )
     * )
     */
    public function show(StaffPatient $staffPatient)
    {
        return response()->json($staffPatient, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/staff-patients/{id}",
     *     summary="Zaktualizuj relację personel-pacjent",
     *     tags={"Staff Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID relacji personel-pacjent"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="staff_id", type="integer", example=1),
     *             @OA\Property(property="patient_id", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Relacja została zaktualizowana",
     *         @OA\JsonContent(ref="#/components/schemas/StaffPatient")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Relacja nie znaleziona"
     *     )
     * )
     */
    public function update(Request $request, StaffPatient $staffPatient)
    {
        $validatedData = $request->validate([
            'staff_id' => 'sometimes|integer',
            'patient_id' => 'sometimes|integer',
        ]);

        $staffPatient->update($validatedData);

        return response()->json($staffPatient, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/staff-patients/{id}",
     *     summary="Usuń relację personel-pacjent",
     *     tags={"Staff Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID relacji personel-pacjent"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Relacja została usunięta"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Relacja nie znaleziona"
     *     )
     * )
     */
    public function destroy(StaffPatient $staffPatient)
    {
        $staffPatient->delete();

        return response()->json(null, 204);
    }
}