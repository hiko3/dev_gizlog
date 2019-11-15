@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'report.store']) !!}
      {!! Form::input('hidden', 'user_id', NULL, ['class' => 'form-control']) !!}
    <div class="form-group form-size-small">
      {!! Form::input('date', 'reporting_time', NULL, ['class' => 'form-control']) !!}
      <span class="help-block"></span>
    </div>
    <div class="form-group">
      {!! Form::input('text', 'title', NULL, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
      <span class="help-block"></span>
    </div>
    <div class="form-group">
      {!! Form::textarea('contents', NULL, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
      <span class="help-block"></span>
    </div>
      {!! Form::button('Add', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

