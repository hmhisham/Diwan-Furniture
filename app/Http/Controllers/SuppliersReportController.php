<?php

namespace App\Http\Controllers;

use App\suppliers_report;
use Illuminate\Http\Request;

class SuppliersReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('suppliers_report.index');
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
     * @param  \App\suppliers_report  $suppliers_report
     * @return \Illuminate\Http\Response
     */
    public function show(suppliers_report $suppliers_report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\suppliers_report  $suppliers_report
     * @return \Illuminate\Http\Response
     */
    public function edit(suppliers_report $suppliers_report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\suppliers_report  $suppliers_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, suppliers_report $suppliers_report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\suppliers_report  $suppliers_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(suppliers_report $suppliers_report)
    {
        //
    }
}
