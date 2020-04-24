@if ($model instanceof App\Question)
    @php
        $name = 'question';
        $firstURISegment = 'questions';
    @endphp
@elseif ($model instanceof App\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp
@endif

@php
   $formId = $name . "-" .$model->id;
   $formAction = "/{$firstURISegment}/{$model->id}/vote";
@endphp

