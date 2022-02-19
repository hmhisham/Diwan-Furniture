<?php

namespace App\Http\Controllers;

use App\store_report;
use Illuminate\Http\Request;

class StoreReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('store_report.index');    
        //
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
     * @param  \App\store_report  $store_report
     * @return \Illuminate\Http\Response
     */
    public function show(store_report $store_report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\store_report  $store_report
     * @return \Illuminate\Http\Response
     */
    public function edit(store_report $store_report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\store_report  $store_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, store_report $store_report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\store_report  $store_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(store_report $store_report)
    {
        //
    }
}
