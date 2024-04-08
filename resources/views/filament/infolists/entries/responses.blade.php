@php
    $domain = \App\Models\Domain::where('id', $domainId);
    $questions = \App\Models\Question::all();

    $hasSubdomain = \App\Models\Subdomain::where('domain_id', $domainId)->exists();

    $totalScore = 0;
    $totalPossibleScore = 0;
@endphp
<div>
    <table style="border: 0.01em solid; border-radius:10px; border-collapse:collapse; border-radius:10px;">
        <thead>
            <tr>
                @if($hasSubdomain)
                <th style="text-align:left; padding:10px;">Subdomain</th>
                @endif
                <th style="text-align:left; padding:10px;">Assessment</th>
                <th style="padding:10px;">Scores</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions->where('domain_id', $domainId) as $question)
            @php
                $key = 'd' . $domainId . 'q' . $loop->iteration;
                $score = $getRecord()->choices[$key] ?? 0;
                $totalScore += $score;
                $totalPossibleScore += 1;
            @endphp
            <tr>
                @if ($hasSubdomain)
                @php
                    $subdomainLabel = $question->subdomain->name;
                @endphp
                <td style="padding:10px;">{{ $subdomainLabel ? $subdomainLabel : '' }}</td>
                @endif
                <td style="padding:10px;">{{ $question->name }}</td>
                <td style="padding:10px;">{{ $score }}</td>
            </tr>
            @endforeach
            <tr>
                <td style="padding:10px;"><strong>Total Score</strong></td>
                <td style="padding:10px;">{{ $totalScore }} ({{ number_format(($totalScore / $totalPossibleScore) * 100, 0) }}%)</td>
            </tr>
        </tbody>
    </table>
    @php
        $totalScore = 0;
        $totalPossibleScore = 0;
    @endphp
</div>
