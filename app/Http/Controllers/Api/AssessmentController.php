<?php

namespace App\Http\Controllers\Api;

use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentController extends Controller
{
    public function index(Request $request)
    {
        $assessments = Assessment::where('organization_id', $request->id)->get();
        return $assessments;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'user_id' => 'required|exists:users,id',
            'clinic_id' => 'required|exists:clinics,id',
            'date' => 'required|date',
            'choices' => 'required|json',
        ]);

        $assessment = Assessment::create($validatedData);

        return response()->json($assessment, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'user_id' => 'required|exists:users,id',
            'clinic_id' => 'required|exists:clinics,id',
            'date' => 'required|date',
            'choices' => 'required|json',
        ]);

        $assessment = Assessment::findOrFail($id);

        $assessment->update($validatedData);

        return response()->json($assessment);
    }

    public function destroy(int $id)
    {
        $assessment = Assessment::findOrFail($id);
        $assessment->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Assessment deleted successfully.',
            ],
            Response::HTTP_OK,
        );
    }
}
