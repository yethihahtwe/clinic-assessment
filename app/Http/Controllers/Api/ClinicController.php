<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clinic;

class ClinicController extends Controller
{
    public function index(Request $request)
    {
        $clinics = Clinic::where('organization_id', $request->id)->get();
        return $clinics;
    }
}
