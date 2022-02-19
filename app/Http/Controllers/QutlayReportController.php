<?php

namespace App\Http\Controllers;

use App\qutlay_report;
use Illuminate\Http\Request;

class QutlayReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('qutlay_report.index');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qutlay_report  $qutlay_report
     * @return \Illuminate\Http\Response
     */
    public function show(qutlay_report $qutlay_report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qutlay_report  $qutlay_report
     * @return \Illuminate\Http\Response
     */
    public function edit(qutlay_report $qutlay_report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qutlay_report  $qutlay_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qutlay_report $qutlay_report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qutlay_report  $qutlay_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(qutlay_report $qutlay_report)
    {
        //
    }
}
