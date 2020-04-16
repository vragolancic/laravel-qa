@if ($answersCount > 0)
    
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ $answersCount ." ".   Str::plural('Answer', $answersCount)}}</h2>
                    </div>
                    <hr>
                    @include('layouts._messages')
                    @foreach ($answers as $answer)
                        <div class="media">
                                <div class="d-flex flex-column vote-controls">
                                    
                                    @include ('shared._vote', [
                                        'model' => $answer
                                    ])
                                    
                                </div>
                                <div class="media-body">
                                    {!! $answer->body_html !!}
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="ml-auto">
                                                    @can('update-answer', $answer)
                                                        <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-outline-info btn-sm">Edit</a>  
                                                    @endcan
                                                    
                                                
                                                <form action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post" class="form-delete">
                                                    @csrf
                                                    @method("DELETE")
                                                        @can('delete-answer', $answer)
                                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Dali ste sigurni')">Delete</button> 
                                                        @endcan
                                                    
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            
                                        </div>
                                        <div class="col-4">
                                        
                                                @include('shared._author',[
                                                    'model' => $answer,
                                                    'label' => 'answerd'
                                                ])
                                            
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
@endif
