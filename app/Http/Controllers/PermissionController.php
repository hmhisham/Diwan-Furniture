<?php

namespace App\Http\Controllers;

use App\Permissions;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\PermissionsCreate;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    function __construct()
    {
        $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Roles = Role::all();
        $Permissions = Permissions::orderBy('id','DESC')->paginate(10);

        return view('permissions.index',compact('Roles','Permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionsCreate $request)
    {
        Permissions::create([
            'name' => $request->input('name'),
            'guard_name' => 'web'
        ]);

        session()->flash('add','تم إنشاء الصلاحية بنجاح');

        return redirect()->back();
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,'.$id
        ], [
            'name.required' => 'أسم الصلاحية مطلوب',
            'name.unique' => 'أسم الصلاحية مستخدم بالفعل',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }   else {
            $permission = Permissions::find($id);
            $permission->name = $request->input('name');
            $permission->save();

            return redirect()->back()
            ->with('update', 'تم تعديل الصلاحية بنجاح');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permissions::find($id)->delete();
        return redirect()->back()
            ->with('delete', 'تم حذف الصلاحية بنجاح');
    }
}
