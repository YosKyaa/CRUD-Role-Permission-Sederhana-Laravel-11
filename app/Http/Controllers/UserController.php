<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role as ContractsRole;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->isMethod('POST')) { 
            $this->validate($request, [ 
                'name'       =>  ['required'],
                'email'      =>  ['required'],
                'password'   =>  ['required'],
            ]);
            $new = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> $request->password,
            ]);
            if($new){
                return redirect()->route('user_index')->with('msg','Data atas ('.$request->name.') BERHASIL ditambahkan!');
            }
        }
            $user = User::select("*")->get();
            $role = Role::select("*")->get();
            $this->authorize('lihat-data-user');
            // dd($data);
            return view('user.index', compact('user','role'));
        }


    public function data(Request $request)
    {
        $data = User::with('roles')->select('*')->orderByDesc("id");
            return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            if (!empty($request->get('search'))) {
                                $search = $request->get('search');
                                $instance->where('name', 'LIKE', "%$search%");
                            }
                        })
                    ->make(true);
    }
    // public function getData()
    // {
    //     $data = Prodi::with('fakultas')->get()->map(function ($prodi) {
    //         return [
    //             'id' => $prodi->id,
    //             'fakultas' => $prodi->fakultas->nama_fakultas,
    //             'kode_prodi' => $prodi->kode_prodi,
    //             'nama_prodi' => $prodi->nama_prodi,
    //             'created_at' => $prodi->created_at,
    //             'updated_at' => $prodi->updated_at,
    //         ];
    //     });

    //     return response()->json($data);
    // }

public function datatables()
    {
        $user = User ::select('*');
        return DataTables::of($user)->make(true);
    }

public function edit($id)
    {
        $prodi = User::all()->findOrFail($id);
        return view('prodi.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       =>  ['required'],
            'email'      =>  ['required'],
            'password'   =>  ['required'],
        ]);

        $prodi = User::findOrFail($id);
        $prodi->update([
            'name'       =>  ['required'],
            'email'      =>  ['required'],
            'password'   =>  ['required'],
        ]);

        return redirect()->route('user_index')->with('user', 'User berhasil diperbarui.');
    }


    public function delete(Request $request){
        $data = User::find($request->id);
        if($data){
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil dihapus!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal dihapus!'
            ]);
        }
    }
}
