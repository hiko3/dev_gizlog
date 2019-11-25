<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\ReportRequest;
use App\Http\Requests\User\SearchReportRequest;
use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use Auth;

class DailyReportController extends Controller
{
    private $report;

    public function __construct(DailyReport $dailyReportInstance)
    {
        $this->report = $dailyReportInstance;
    }

    /**
     * 日報一覧画面表示
     *
     * @param SearchReportRequest $request
     * @return \Illuminate\View\View
     */
    public function index(SearchReportRequest $request)
    {
        $searchMonth = $request->input('search-month');
        $reports = $this->report->searchDailyReport(Auth::id(), $searchMonth);
        return view('user.daily_report.index', compact('reports', 'searchMonth'));
    }

    /**
     * 日報作成画面表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.daily_report.create');
    }

    /**
     * 日報新規登録処理
     *
     * @param ReportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReportRequest $request)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = Auth::id();
        $this->report->create($inputs);
        return redirect()->route('report.index');
    }

    /**
     * 日報詳細画面表示
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.show', compact('report'));
    }

    /**
     * 日報編集画面表示
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    /**
     * 日報更新処理
     *
     * @param ReportRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReportRequest $request, $id)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = Auth::id();
        $this->report->find($id)->fill($inputs)->save();
        return redirect()->route('report.index');
    }

    /**
     * 日報削除処理
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->report->find($id)->delete();
        return redirect()->route('report.index');
    }
}
