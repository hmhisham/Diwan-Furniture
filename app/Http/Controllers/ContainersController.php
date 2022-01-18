<?php

namespace App\Http\Controllers;

use App\Suppliers;
use App\Containers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContainersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Containers = Containers::paginate(10);
        $Suppliers = Suppliers::all();

        return view('containers.index',compact('Containers','Suppliers'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
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
        Containers::create([
            'cont_no' => $request->cont_no,
            'cont_date' => $request->cont_date,
            'cont_supplier' => $request->cont_supplier,
            'cont_type_supply' => $request->cont_type_supply,
            'create_by' => Auth::User()->id
        ]);
        return redirect()->back()->with('add','تم اضافة الحاوية بنجاح');
    }

    public function expenses(Request $request, $id)
    {
        $Containers = Containers::find($id);
        $Containers->update([
            'cont_out_expenses' => $request->cont_out_expenses,
            'cont_customs' => $request->cont_customs,
            'cont_in_expenses' => $request->cont_in_expenses
        ]);
        
        return redirect()->back()->with('add_expenses','تم اضافة مصاريف الحاوية بنجاح');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
