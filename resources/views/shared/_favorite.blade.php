<a title="Omiljeno" 
        class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }}"
        onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();"
        >
        <i class="fa fa-star fa-2x"></i>
        <span class="favorites-count">{{$model->favorites_count}}</span>
    </a>
    <form action="/questions/{{$model->id}}/favorites" style="display: none;" id="favorite-question-{{ $model->id }}" method="post">
        @csrf
        @if ($model->is_favorited)
            @method('DELETE')
        @endif
    </form>