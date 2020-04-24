<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return $question->answers()->with('user')->simplePaginate(3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $answer = $question->answers()->create(['body' => $request->body, 'user_id' => \Auth::id()]);

        if ($request->expectsJson()) 
        {
            return response()->json([
                'message' => 'uspesno ste napravili odgovor',
                'answer' => $answer
            ]);
        }

        return back()->with('success', "Vas odgovor je uspesno dodat");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validate([
            'body' => 'required',
        ]));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Odgovor je uspesno azuriran',
                'body_html' => $answer->body_html
            ]);
        }

        return redirect()->route('questions.show', $question->slug)->with('success', 'Odgovor je uspesno azuriran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);
        
        $answer->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Odgovor je uspesno obrisan',
            ]);
        }


        return redirect()->back()->with('success', "Tvoje pitanje je uspesno obrisano");
    }
}
