<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\TagCategory;
use App\Http\Requests\User\QuestionRequest;
use App\Http\Requests\User\SearchQuestionRequest;
use Auth;

class QuestionController extends Controller
{
    private $question;
    private $category;

    public function __construct(Question $questionInstance, TagCategory $categoryInstance)
    {
        $this->middleware('auth');
        $this->question = $questionInstance;
        $this->category = $categoryInstance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchQuestionRequest $request)
    {
        $wordVal = $request->input('search_word');
        $categoryVal = $request->input('tag_category_id');
        $questions = $this->question->whereCategory($categoryVal)
                ->searchTitle($wordVal)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        $categories = $this->category->all();
        return view('user.question.index', compact('questions','categories', 'wordVal', 'categoryVal'));
    }

    public function mypage()
    {
        $id = Auth::id();
        $questions = $this->question->where('user_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        return view('user.question.mypage', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lists = $this->category->pluck('name', 'id');
        $lists->prepend('Select Category');
        return view('user.question.create', compact('lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $inputs = $request->fetchQuestion();
        $inputs['user_id'] = Auth::id();
        $this->question->create($inputs);
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->find($id);
        return view('user.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lists = $this->category->pluck('name', 'id');
        $question = $this->question->find($id);
        return view('user.question.edit', compact('question', 'lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        $inputs = $request->fetchQuestion();
        $this->question->find($id)->update($inputs);
        return redirect()->route('question.mypage', Auth::id());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
