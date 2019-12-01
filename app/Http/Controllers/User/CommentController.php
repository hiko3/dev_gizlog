<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Question;

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

    public function store(Request $request)
    {
        $inputs = $request->all();
        $question = $this->question->find($inputs['question_id']);
        $this->comment->create($inputs);
        return redirect()->route('question.show', ['question' => $question]);
    }
}
