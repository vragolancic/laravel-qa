@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title  }}</h1>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Vrati se na sva pitanja</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="Ovo pitanje je korisno" 
                            class="vote-up {{ Auth::guest() ? 'off' : ''}}"
                            onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit();"
                            >
                                <i class="fa fa-caret-up fa-3x"></i>
                            </a>

                            <form action="/questions/{{$question->id}}/vote" style="display: none;" id="up-vote-question-{{ $question->id }}" method="post">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>

                            <span class="votes-count" >{{ $question->votes_count }}</span>

                            <a title="Ovo pitanje je nekorisno" 
                                class="vote-down {{ Auth::guest() ? 'off' : ''}}"
                                onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit();"
                                >
                                <i class="fa fa-caret-down fa-3x"></i>
                            </a>
                            <form action="/questions/{{$question->id}}/vote" style="display: none;" id="down-vote-question-{{ $question->id }}" method="post">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                            <a title="Omiljeno" 
                                class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();"
                                >
                                <i class="fa fa-star fa-2x"></i>
                                <span class="favorites-count">{{$question->favorites_count}}</span>
                            </a>
                            <form action="/questions/{{$question->id}}/favorites" style="display: none;" id="favorite-question-{{ $question->id }}" method="post">
                                @csrf
                                @if ($question->is_favorited)
                                    @method('DELETE')
                                @endif
                            </form>
                        </div>
                        <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="float-right">
                                    <span class="text-muted">Answerd {{ $question->created_date }}</span>
                                    <div class="media">
                                        <a href="{{ $question->user->url }}" class="pr-2">
                                            <img width="40" src="https://ramcotubular.com/wp-content/uploads/default-avatar.jpg" >
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index',[
        'answers' => $question->answers,
        'answersCount' => $question->answers_count
    ])
    @include('answers._create')
</div>
@endsection