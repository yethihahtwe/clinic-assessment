<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Exports\ScoresExport;
use Maatwebsite\Excel\Facades\Excel;

class AssessmentController extends Controller
{
    public function export(int $id)
	{
		$assessment = Assessment::findOrFail($id);
        $choices = $assessment->choices;
		$clinic = $assessment->clinic->name;
		$date = $assessment->date;
        $assessor = $assessment->assessor->name;
        $organization = $assessment->organization->name;
		return Excel::download(new ScoresExport([$choices], $clinic, $date, $assessor, $organization), $clinic . '_' . $date . '_scores.xlsx');
	}
}
