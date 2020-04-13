@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Sva Pitanja</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary"> Kreiraj pitanje</a>
                        </div>
                    </div>
                    
                </div>

                <div class="card-body">
                    @include('layouts._messages')
                    @foreach ($questions as $question)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ $question->votes_count }}</strong> {{ Str::plural('vote', $question->votes_count) }}
                                </div>
                                <div class="status {{ $question->status }}">
                                    <strong>{{ $question->answers_count }}</strong> {{ Str::plural('answer', $question->answers_count) }}
                                </div>
                                <div class="view">
                                    {{ $question->views ." ". Str::plural('view', $question->views) }}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                                    <div class="ml-auto">
                                        @can('update-question', $question)
                                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-outline-info btn-sm">Edit</a>  
                                        @endcan
                                        
                                    </div>
                                    <form action="{{ route('questions.destroy', $question->id) }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <div class="ml-2">
                                            @can('delete-question', $question)
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Dali ste sigurni')">Delete</button> 
                                            @endcan
                                        </div>
                                    </form>
                                </div>
                                <p class="lead">
                                    Asked by
                                    <a href="{{ $question->user->url }}">{{$question->user->name}}</a>
                                    <small class="text-muted">{{ $question->created_date }}</small>
                                </p>
                                {{ Str::limit($question->body,200) }}
                            </div>
                        </div>
                        <hr>
                    @endforeach
                        <div class="text-center">
                            {{ $questions->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection