@can('accept-answer', $model)
    <a title="Oznaci odgovor kao najbolji" 
        class="{{$model->status}} mt-2"
        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();"
        >
        <i class="fa fa-check fa-2x"></i>
    </a>
    <form action="{{  route('answers.accept', $model->id)  }}" style="display: none;" id="accept-answer-{{ $model->id }}" method="post">
        @csrf
    </form>
@else
    @if ($model->is_best)
        <a title="Vlasnik pitanja je prihvato ovaj osgovor kao najbolji" 
            class="{{$model->status}} mt-2">
            <i class="fa fa-check fa-2x"></i>
        </a>
    @endif
@endcan