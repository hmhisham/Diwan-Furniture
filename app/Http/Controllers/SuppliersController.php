<?php

namespace App\Http\Controllers;

use App\Suppliers;
use Illuminate\Http\Request;
use App\Http\Requests\SuppliersCreate;

class SuppliersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:قائمة الموردين', ['only' => ['index']]);
        $this->middleware('permission:اضافة مورد', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل مورد', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف مورد', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Suppliers = Suppliers::orderBy('name','ASC')->paginate(10);

        return view('suppliers.index',compact('Suppliers'))
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
    public function store(SuppliersCreate $request)
    {
        $input = $request->all();
        Suppliers::create($input);
        return redirect()->back()
            ->with('add','تم إضافة المورد بنجاح');
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
        $this->validate($request, [
            'name' => 'required|unique:suppliers,name,'.$id,
            'email' => 'email'
        ],[
            'name.required' => 'أسم المورد مطلوب',
            'name.unique' => 'أسم المورد تم أستخدامه مسبقاً',
            'email.email' => 'يجب إدخال بريد ألكتروني صحيح',
        ]);

        $input = $request->all();
        $Suppliers = Suppliers::find($id);
        $Suppliers->update($input);

        return redirect()->back()
            ->with('update','تم تحديث بيانات المورد بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Suppliers::find($id)->delete();
        return redirect()->back()
            ->with('delete','تم حف بيانات المورد بنجاح');
    }
}
