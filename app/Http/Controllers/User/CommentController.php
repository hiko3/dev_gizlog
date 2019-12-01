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
        $input = $request->all();
        $question = $this->question->find($input['question_id']);
        $this->comment->create($input);
        return redirect()->route('question.show', ['question' => $question]);
    }
}
