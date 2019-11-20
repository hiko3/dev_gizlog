@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper daily-report">
    {{-- <form action="{{ route('report.index') }}"> --}}
    {!! Form::open(['route' => ['report.index'], 'method' => 'GET']) !!}
      {!! Form::input('month', 'search-month', NULL, ['class' => 'form-control']) !!}
      {!! Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-icon', 'type' => 'submit']) !!}
    {!! Form::close() !!}
      {{-- <input class="form-control" name="search-month" type="month"> --}}
      {{-- <button type="submit" class="btn btn-icon"><i class="fa fa-search"></i></button>
    </form> --}}
    <a class="btn btn-icon" href=" {{ route('report.create') }} "><i class="fa fa-plus"></i></a>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">Date</th>
          <th class="col-xs-3">Title</th>
          <th class="col-xs-5">Content</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reports as $report)
          <tr class="row">
            <td class="col-xs-2">{{ $report->reporting_time->format('m/d (D)') }}</td>
            <td class="col-xs-3">{{ $report->title }}</td>
            <td class="col-xs-5">{{ $report->content }}</td>
            <td class="col-xs-2"><a class="btn" href="{{ route('report.show', $report->id )}}"><i class="fa fa-book"></i></a></td>
          </tr>
         @endforeach 
      </tbody>
    </table>
      <div class="text-center">
        {{ $reports->links() }}
      </div>
  </div>
</div>

@endsection

