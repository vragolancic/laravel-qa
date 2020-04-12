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