@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'report.store']) !!}
    <div class="form-group form-size-small {{ $errors->has('reporting_time') ? ' has-error' : '' }}">
      {!! Form::input('date', 'reporting_time', NULL, ['class' => 'form-control']) !!}
      <span class="help-block">{{ $errors->first('reporting_time')}}</span>
    </div>
    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
      {!! Form::input('text', 'title', NULL, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
      <span class="help-block">{{ $errors->first('title') }}</span>
    </div>
    <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
      {!! Form::textarea('content', NULL, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
      <span class="help-block">{{ $errors->first('content') }}</span>
    </div>
      {!! Form::submit('Add', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

