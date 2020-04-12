@extends('layouts.app')

@section('content')

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card mt-2">
             <div class="card-body">
                 <div class="card-title">
                    <h3>Editovanje odgovora za pitanje : {{ $question->title }}</h3>
                 </div>
                 <hr>
                <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="post">
                     @csrf
                     @method('PUT') 
                     <div class="form-group">
                        <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="" cols="30" rows="10">{{ $answer->body }}</textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                     </div>
                     <div class="form-group">
                         <button type="submit" class="btn btn-outline-primary">
                             Update
                         </button>
                     </div>
                 </form>
             </div>
        </div>
    </div>
</div>

@endsection