<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'exists:permissions,name'
            ]
        ]);
        ModelsRole::create([
            'name' => $request->name
        ]);

        return redirect('role-permission.role.index')->with('status','ModelsRole Created Successfully');

    }
    public function edit()
    {

    }

    public function update()
    {

    }
    public function delete($id)
    {
        $prodi = ModelsRole::findOrFail($id);
        $prodi->delete();
        return response()->json(['success' => 'Prodi berhasil dihapus']);
    }
}

