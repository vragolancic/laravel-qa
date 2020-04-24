<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept', $answer);
        // if (\Gate::denies('accept-answer', $answer)) {
        //     abort(403, "Ne dozvoljen pristup");
        // }
        $answer->question->acceptBestAnswer($answer);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Odgovor je uspesno oznacen kao najbolji',
            ]);
        }

        return back();
    }
}
