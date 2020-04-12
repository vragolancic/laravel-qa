<div class="row mt-4">
    <div class="col-md-12">
        <div class="card mt-2">
             <div class="card-body">
                 <div class="card-title">
                    <h3>Vas odgovor</h3>
                 </div>
                 <hr>
                <form action="{{ route('questions.answers.store', $question->id) }}" method="post">
                     @csrf 
                     <div class="form-group">
                        <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="" cols="30" rows="10"></textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                     </div>
                     <div class="form-group">
                         <button type="submit" class="btn btn-outline-primary">
                             Pitaj
                         </button>
                     </div>
                 </form>
             </div>
        </div>
    </div>
</div>