<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Question;
use App\Http\Requests\User\CommentRequest;

class CommentController extends Controller
{
    private $comment;
    private $question;

    public function __construct(Comment $commentInstance, Question $questionInstance)
    {
        $this->middleware('auth');
        $this->comment = $commentInstance;
        $this->question = $questionInstance;
    }

    /**
     * コメント作成処理
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request)
    {
        $inputs = $request->requestComment();
        $question = $this->question->find($inputs['question_id']);
        $this->comment->create($inputs);
        return redirect()->route('question.show', compact('question'));
    }
}
