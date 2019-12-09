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
     * 質問一覧表示
     *
     * @param SearchQuestionRequest $request
     * @return \Illuminate\View\View
     */
    public function index(SearchQuestionRequest $request)
    {
        $searchWord = $request->input('search_word');
        $categoryId = $request->input('tag_category_id');
        $questions = $this->question->searchOrDisplay($searchWord, $categoryId);
        $categories = $this->category->all();
        return view('user.question.index', compact('questions', 'categories', 'searchWord', 'categoryId'));
    }

    /**
     * マイページ表示
     *
     * @return \Illuminate\View\View
     */
    public function mypage()
    {
        $userId = Auth::id();
        $questions = $this->question->showMypage($userId);
        return view('user.question.mypage', compact('questions'));
    }

    /**
     * 質問確認画面表示 
     *
     * @param QuestionRequest $request
     * @return \Illuminate\View\View
     */
    public function confirm(QuestionRequest $request)
    {
        $question = $request->requestConfirm();
        $categoryId = $request->input('tag_category_id');
        $category = $this->category->find($categoryId);
        return view('user.question.confirm', compact('question', 'category'));
    }

    /**
     * 質問新規作成画面表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $lists = $this->category->pluck('name', 'id')->prepend('Select Category');
        return view('user.question.create', compact('lists'));
    }

    /**
     * 質問新規投稿作成
     *
     * @param QuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuestionRequest $request)
    {
        $inputs = $request->requestQuestion();
        $inputs['user_id'] = Auth::id();
        $this->question->create($inputs);
        return redirect()->route('question.index');
    }

    /**
     * 質問詳細画面表示
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $question = $this->question->find($id);
        return view('user.question.show', compact('question'));
    }

    /**
     * 質問編集画面
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $lists = $this->category->pluck('name', 'id');
        $question = $this->question->find($id);
        return view('user.question.edit', compact('question', 'lists'));
    }

    /**
     * 質問更新処理
     *
     * @param QuestionRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(QuestionRequest $request, $id)
    {
        $inputs = $request->requestQuestion();
        $this->question->find($id)->update($inputs);
        return redirect()->route('question.mypage');
    }

    /**
     * 質問削除処理
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return back();
    }
}
