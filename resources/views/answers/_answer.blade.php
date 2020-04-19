<div class="media post">
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
            
                    <user-info :model="{{ $question }}" label='answerd'></user-info>
                
            </div>
        </div>
        
    </div>
</div>