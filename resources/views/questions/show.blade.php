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
                            <a title="Ovo pitanje je korisno" class="vote-up">
                                <i class="fa fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count" >1230</span>
                            <a title="Ovo pitanje je nekorisno" class="vote-down off">
                                <i class="fa fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Omiljeno" class="favorite mt-2 favorited">
                                <i class="fa fa-star fa-2x"></i>
                                <span class="favorites-count">123</span>
                            </a>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-2">
                 <div class="card-body">
                     <div class="card-title">
                        <h2>{{ $question->answers_count ." ".   Str::plural('Answer', $question->answers_count)}}</h2>
                     </div>
                     <hr>
                     @foreach ($question->answers as $answer)
                         <div class="media">
                                <div class="d-flex flex-column vote-controls">
                                    <a title="Ovo Odgovor je korisno" class="vote-up">
                                        <i class="fa fa-caret-up fa-3x"></i>
                                    </a>
                                    <span class="votes-count" >1230</span>
                                    <a title="Ovo Odgovor je nekorisno" class="vote-down off">
                                        <i class="fa fa-caret-down fa-3x"></i>
                                    </a>
                                    <a title="Oznaci odgovor kao najbolji" class="vote-accepted mt-2">
                                        <i class="fa fa-check fa-2x"></i>
                                    </a>
                                </div>
                                <div class="media-body">
                                    {!! $answer->body_html !!}
                                    <div class="float-right">
                                        <span class="text-muted">Answerd {{ $answer->created_date }}</span>
                                        <div class="media">
                                            <a href="{{ $answer->user->url }}" class="pr-2">
                                                <img width="40" src="https://ramcotubular.com/wp-content/uploads/default-avatar.jpg" >
                                            </a>
                                            <div class="media-body mt-1">
                                                <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                         <hr>
                     @endforeach
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection