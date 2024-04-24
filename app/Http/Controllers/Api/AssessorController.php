<?php

namespace App\Http\Controllers\Api;

use App\Models\Assessor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessorController extends Controller
{
    public function index(Request $request)
    {
        $assessors = Assessor::where('organization_id', $request->id)->get();
        return $assessors;
    }
}
