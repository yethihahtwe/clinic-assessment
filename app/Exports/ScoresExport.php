<?php

namespace App\Exports;
use App\Models\Assessment;
use App\Models\Question;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ScoresExport implements FromArray, WithHeadings
{
	protected $choices;

	public function __construct(array $choices)
	{
		$this->choices = $choices;
	}

	public function array(): array
	{
		return $this->choices;
	}

	public function headings():array
	{
		$questions = Question::pluck('name')->toArray();
		return $questions;
	}
}
