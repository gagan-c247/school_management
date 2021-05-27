<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleRequest;
use DB;
class RoleController extends Controller
{
    protected $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->middleware('permission:role-permission');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        $permissions = Permission::where('guard_name','web')->get();
        return view('backend.role.index',compact('roles'))->with('role',$this->role);
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
    public function store(RoleRequest $request)
    {
        //  return $request->all();
        $role = Role::create(['guard_name'=>$request['type'],'name'=>$request['name']]);
        $role->syncPermissions($request->input('permission'));
        session()->flash('success','Inserted Successfully!');
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
        $role = Role::find($id);
        $guard = Role::find($id)->guard_name;
        $roles = Role::get();
        $permissions = Permission::where('guard_name',$guard)->get();
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('backend.role.index',compact('role','roles','permissions','rolePermissions'));
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
        // return $request->all();
        $role = Role::find($id);
        if($request->name != ''){
            $role->name = $request->input('name');
            $role->save();
        } 
        
        // if($request->input('permission') != ''){
            DB::table('role_has_permissions')->where('role_id',$id)->delete();
            $role->givePermissionTo($request->input('permission'));
        // }
        session()->flash('success','Updated Successfully!');
        return redirect()->back();
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
    public function permissionSearch(Request $request){
        if($request->ajax()){
            // return $request->type;
            $permissions = Permission::where('guard_name',$request->type)->get();
            $output ='';
            foreach($permissions as $permission){   
                $output .= '<input type="checkbox" name="permission[]" value="'.$permission->name.'" class="">'.$permission->name.'<br>';
            }
            return response()->json(['permissions'=>$output,'status'=>'success']);
        }
    }
}
