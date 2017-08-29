<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Auth;
//use lluminate\Database\Query;
class QuestionsController extends Controller
{
    //
    protected  $questionRepository;
    public function __construct(QuestionRepository $questionRepository)
    {
       $this->middleware('auth')->except(['index','show']) ;
        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        $questions = $this->questionRepository->getQuestionsFeed();
        return view('questions.index',compact('questions'));
    }

    public function create()
    {
        return view('questions.make');
    }

    public function store(Request $request)
    {

        $topics = $this->questionRepository->mormalizeTopic($request->get('topics'));
//        dd($topics);
        $rules = [
            'title' => 'required|min:6|max:196',
            'content' => 'required|min:26',
        ];
        $message = [
            'title.required' => '标题不能为空',
            'title.min' => '标题不能少于六个字符',
            'title.max' => '标题不能大于196个字符',
            'content.required' => '内容不能为空',
            'content.min' => '内容不能少于26个字符',
        ];
        $this->validate($request,$rules,$message);
//        dd($request->get('topics'));
        $data = [
            'title' =>$request->get('title'),
            'body' =>$request->get('content'),
            'user_id' => Auth::id(),
        ];
        $question = $this->questionRepository->create($data);
        $question->topics()->attach($topics);
        return redirect()->route('question.show',[$question->id]);
    }

    public function show($id)
    {
        $question = $this->questionRepository->byIdWithTopicsAndAnswers($id);
//        dd($question);
        return view('questions.show',compact('question'));
    }

    public function edit($id)
    {
        $question = $this->questionRepository->byId($id);
        if(Auth::user()->owns($question)){
            return view('questions.edit',compact('question'));
        }

        return back();

    }


    public function update(Request $request,$id)
    {
        $question = $this->questionRepository->byId($id);

        $topics = $this->questionRepository->mormalizeTopic($request->get('topics'));

        $question->update([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
        ]);

        $question->topics()->sync($topics);
        return redirect()->route('question.show',[$question->id]);

    }


    public function destroy($id)
    {
        $question = $this->questionRepository->byId($id);
        if(Auth::user()->owns($question)){
            $question->delete();

            return redirect('/');
        }

        return back();
    }

}
