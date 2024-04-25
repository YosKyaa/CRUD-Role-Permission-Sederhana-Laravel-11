<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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

    
    function edit($id, Request $request){
        $roles = Role::get();
        if ($request->isMethod('POST')) {
            $this->validate($request, [ 
                'email'=> ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id, 'id')],
                'name' => ['required', 'string'],
            ]);
            User::where('id',$id)->update([
                'name'=> $request->name,
                'email'=> $request->email,
            ]);
            $detach = User::find($id)->roles()->detach();
            $attach = User::find($id)->roles()->attach($request->roles);
            return redirect()->route('user.edit')->with('msg','Profil telah diperbarui!');
        }
        $data = User::find($id);
        if($id == 1 || $data == null){
            abort(403, "Access not allowed!");
        }
        return view('user.edit', compact('data','roles'));
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
