<?php

namespace App\Http\Controllers;

use App\qutlay;
use Illuminate\Http\Request;

class QutlayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('qutlay.index');
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
     * @param  \App\qutlay  $qutlay
     * @return \Illuminate\Http\Response
     */
    public function show(qutlay $qutlay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qutlay  $qutlay
     * @return \Illuminate\Http\Response
     */
    public function edit(qutlay $qutlay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qutlay  $qutlay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qutlay $qutlay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qutlay  $qutlay
     * @return \Illuminate\Http\Response
     */
    public function destroy(qutlay $qutlay)
    {
        //
    }
}
