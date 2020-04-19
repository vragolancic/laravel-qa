<answer :answer="{{$answer}}" inline-template>
    <div class="media post">
        <div class="d-flex flex-column vote-controls">
            
            @include ('shared._vote', [
                'model' => $answer
            ])
            
        </div>
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea v-model="body" rows="10" class="form-control"></textarea>
                </div>
                <button class="btn btn-outline-info btn-sm" :disabled="isInvalid">Update</button>
                <button @click.prevent = "cancel" class="btn btn-outline-danger btn-sm" type="button">Cancel</button>
            </form>
            <div v-if="!editing">
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                                @can('update-answer', $answer)
                                    <a @click.prevent="edit" class="btn btn-outline-info btn-sm">Edit</a>  
                                @endcan
                                
                            @can('delete-answer', $answer)
                            <form action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post" class="form-delete">
                                @csrf
                                @method("DELETE")
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Dali ste sigurni')">Delete</button> 
                            </form>
                            @endcan
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
    </div>
</answer>