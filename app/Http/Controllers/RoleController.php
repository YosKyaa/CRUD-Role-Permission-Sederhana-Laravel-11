<?php

namespace App\Http\Controllers;

use App\Models\Permission as ModelsPermission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role as ModelsRole;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('POST')) { 
            $this->validate($request, [ 
                'name'   => ['required', Rule::unique('role')]
        ]);
        $new = ModelsRole::create([
            'name' => $request->name
        ]);
        if($new){
            return redirect()->route('role-permission.role.index')->with('msg','Data atas ('.$request->name.') BERHASIL ditambahkan!');
        }
    }
            $permissions = ModelsRole::select("*")->get();
            // dd($data);
            return view('role-permission.role.index', compact('permissions'));
        }

        public function data(Request $request)
        {
            $data = ModelsRole::with('permissions')->select('*')->orderByDesc("id");
                return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            if (!empty($request->get('search'))) {
                                $search = $request->get('search');
                                $instance->where('name', 'LIKE', "%$search%");
                            }
                        })
                        ->make(true);
        }
        public function create()
    {
        return view('role-permission.role.create');
    }

    
  

    function edit($id, Request $request){
        $permissions = ModelsPermission::get();
        if ($request->isMethod('POST')) {
            $this->validate($request, [ 
                'name' => ['required', 'string'],
            ]);
            Role::where('id',$id)->update([
                'name'=> $request->name,
            ]);
            $detach = Role::find($id)->roles()->detach();
            $attach = Role::find($id)->roles()->attach($request->roles);
            return redirect()->route('role.edit')->with('msg','Profil telah diperbarui!');
        }
        $data = Role::find($id);
        if($id == 1 || $data == null){
            abort(403, "Access not allowed!");
        }
        return view('role-permission.role.edit', compact('data','permissions'));
    }




}

