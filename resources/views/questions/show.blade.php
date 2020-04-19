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
                       @include('shared._vote', [
                           'model' => $question,
                       ])
                        <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="float-right">
                                    
                                    <user-info :model="{{ $question }}" label='answerd'></user-info>
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