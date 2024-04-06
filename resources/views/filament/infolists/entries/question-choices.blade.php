@php
    $domains = \App\Models\Domain::all();
    $questions = \App\Models\Question::all();
    $totalScore = 0;
    $totalPossibleScore = 0;
@endphp

<div>
    @foreach ($domains as $domain)
    @php
        $hasSubdomain = \App\Models\Subdomain::where('domain_id', $domain->id)->exists();
    @endphp
    <h1><strong>{{ $domain->name }}</strong></h1>
    <table style="border: 0.01em solid; border-radius:10px; border-collapse:collapse; border-radius:10px;">
        <thead>
            <tr>
                @if ($hasSubdomain)
                <th style="text-align:left; padding:10px;">Subdomain</th>
                @endif
                <th style="text-align:left; padding:10px;">Assessment</th>
                <th style="padding:10px;">Scores</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions->where('domain_id', $domain->id) as $question)
                @php
                    $key = 'd' . $domain->id . 'q' . $loop->iteration;
                    $score = $getRecord()->choices[$key] ?? 0;
                    $totalScore += $score;

                    $totalPossibleScore += 1;
                @endphp
                <tr>
                    @if ($hasSubdomain)
                        @php
                            $subdomain = $question->subdomain;
                        @endphp
                        <td style="padding:10px;">{{ $subdomain ? $subdomain->name : '' }}</td>
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
    <br />
    @endforeach
</div>
