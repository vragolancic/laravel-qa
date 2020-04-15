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
                                <a title="Ovo pitanje je korisno" 
                                class="vote-up {{ Auth::guest() ? 'off' : ''}}"
                                onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();"
                                >
                                    <i class="fa fa-caret-up fa-3x"></i>
                                </a>

                                <form action="/answers/{{$answer->id}}/vote" style="display: none;" id="up-vote-answer-{{ $answer->id }}" method="post">
                                    @csrf
                                    <input type="hidden" name="vote" value="1">
                                </form>

                                <span class="votes-count" >{{ $answer->votes_count }}</span>

                                <a title="Ovo pitanje je nekorisno" 
                                    class="vote-down {{ Auth::guest() ? 'off' : ''}}"
                                    onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();"
                                    >
                                    <i class="fa fa-caret-down fa-3x"></i>
                                </a>
                                <form action="/answers/{{$answer->id}}/vote" style="display: none;" id="down-vote-answer-{{ $answer->id }}" method="post">
                                    @csrf
                                    <input type="hidden" name="vote" value="-1">
                                </form>
                                @can('accept-answer', $answer)
                                    <a title="Oznaci odgovor kao najbolji" 
                                        class="{{$answer->status}} mt-2"
                                        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();"
                                        >
                                        <i class="fa fa-check fa-2x"></i>
                                    </a>
                                    <form action="{{  route('answers.accept', $answer->id)  }}" style="display: none;" id="accept-answer-{{ $answer->id }}" method="post">
                                        @csrf
                                    </form>
                                @else
                                    @if ($answer->is_best)
                                        <a title="Vlasnik pitanja je prihvato ovaj osgovor kao najbolji" 
                                            class="{{$answer->status}} mt-2">
                                            <i class="fa fa-check fa-2x"></i>
                                        </a>
                                    @endif
                                @endcan
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
                    </div>
                     <hr>
                 @endforeach
             </div>
        </div>
    </div>
</div>