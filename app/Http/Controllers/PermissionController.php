<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('POST')) { 
            $this->validate($request, [ 
                'name'   => ['required', Rule::unique('permissions')]
        ]);
        $new = Permission::create([
            'name' => $request->name
        ]);
        if($new){
            return redirect()->route('role-permission.permission.index')->with('msg','Data atas ('.$request->name.') BERHASIL ditambahkan!');
        }
    }
            $permissions = Permission::select("*")->get();
            // dd($data);
            return view('role-permission.permission.index', compact('permissions'));
        }

        public function data(Request $request)
        {
            $data = Permission::select('*')->orderByDesc("id");
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
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'exists:permissions,name'
            ]
        ]);
        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status','Permission Created Successfully');

    }
    public function edit()
    {

    }

    public function update()
    {

    }
    public function delete($id)
    {
        $prodi = Permission::findOrFail($id);
        $prodi->delete();
        return response()->json(['success' => 'Prodi berhasil dihapus']);
    }
}
