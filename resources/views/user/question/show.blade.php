@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問詳細</h1>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      <img src="" class="avatar-img">
      <p>{{ $question->user->name }}さんの質問({{ $question->tagCategory->name }}) {{ $question->created_at }}</p>
      <p class="question-date"></p>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $question->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{{ $question->content }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    <div class="comment-list">
          @foreach($question->comment as $c)
        <div class="comment-wrap">
          <div class="comment-title">
            <img src="{{ $c->user->avatar }}" class="avatar-img">
            <p>{{ $c->user->name }}</p>
            <p class="comment-date"></p>
          </div>
            <div class="comment-body">{{ $c->comment }}</div>
        </div>
          @endforeach
    </div>
  <div class="comment-box">
    <form>
      <input name="user_id" type="hidden" value="">
      <input name="question_id" type="hidden" value="">
      <div class="comment-title">
        <img src="" class="avatar-img"><p>コメントを投稿する</p>
      </div>
      <div class="comment-body">
        <textarea class="form-control" placeholder="Add your comment..." name="comment" cols="50" rows="10"></textarea>
        <span class="help-block"></span>
      </div>
      <div class="comment-bottom">
        <button type="submit" class="btn btn-success">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </button>
      </div>
    </form>
  </div>
</div>
@endsection