<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$questions = null;
		$role_id = null;
		$flag = -1;
		$answers = null;
		$created_at = null;
		$grafico_1 = null;
		$grafico_2 = null;
		
		try {
			$questions = Question::all();
			$role_id = Auth::user()->role_id;
			$flag = -1;
			
			$created_at = Answer::where('user_id', Auth::id())->max("created_at");
			if (time() - strtotime($created_at) <  2592000) { // Se valida que la ultima respuesta se haya registrado hace más de un mes
				$flag = 1;
				$questions = DB::table('questions')
					->join('answers', 'questions.id', '=', 'answers.question_id')
					->select('questions.question', 'answers.answer')
					->where('answers.user_id',  Auth::id())
					->where('answers.state',  '1')
					->get();
			}
			
			if ($role_id == 1){
			$grafico_1 = DB::table('questions')
						->join('answers', 'questions.id', '=', 'answers.question_id')
						->select(DB::raw('count(*) as count, answer'))
						->where('questions.id',  2)
						->groupby('answers.answer')
						->get();
						
			$grafico_2 = DB::table('questions')
						->join('answers', 'questions.id', '=', 'answers.question_id')
						->select(DB::raw('count(*) as count, answer'))
						->where('questions.id',  3)
						->groupby('answers.answer')
						->get();
			
			$answers = DB::table('answers')
					->join('questions', 'questions.id', '=', 'answers.question_id')
					->join('users', 'users.id', '=', 'answers.user_id')
					->select('users.name', 'answers.answer', 'questions.question', 'answers.created_at')
					->get();
			}	
        }
		catch (\Exception $e) {
			$request->session()->flash('warning', $e->getMessage());
		}
		return view('home')->with(compact("questions","role_id", "flag", "answers", "created_at", "grafico_1", "grafico_2"));
    }
	
	public function responder(Request $request){
		try {
			Answer::where('user_id', Auth::id())->update(['state' => '0']);
			$question_1 = $request->input('question_1');
			$question_2 = $request->input('question_2');
			$question_3 = $request->input('question_3');
			
			$answer = new Answer;
			$answer->question_id = 1;
			$answer->answer = $question_1;
			$answer->user_id = Auth::id();
			$answer->state = '1';
			$answer->save();
			
			$answer = new Answer;
			$answer->question_id = 2;
			$answer->answer = $question_2;
			$answer->user_id = Auth::id();
			$answer->state = '1';
			$answer->save();
			
			$answer = new Answer;
			$answer->question_id = 3;
			$answer->answer = $question_3;
			$answer->user_id = Auth::id();
			$answer->state = '1';
			$answer->save();
			$request->session()->flash('status', 'Respuestas registradas correctamente!');			
		}
		catch (\Exception $e) {
			$request->session()->flash('error', $e->getMessage());
		}
		return redirect()->route('home');
	}
}
