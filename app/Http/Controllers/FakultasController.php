<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->isMethod('POST')) { 
            $this->validate($request, [ 
                'kode_fakultas'    => ['required'],
                'nama_fakultas'    => ['required'],
            ]);
            $new = Fakultas::create([
                'kode_fakultas'=> $request->kode_fakultas,
                'nama_fakultas'=> $request->nama_fakultas,
            ]);
            if($new){
                return redirect()->route('fakultas_index')->with('msg','Data atas ('.$request->nama_fakultas.') dengan '.$request->kode_fakultas.' BERHASIL ditambahkan!');
            }
        }
            $fakultas = Fakultas :: select("*")->get();
            return view('fakultas.index', compact('fakultas'));
        }

    public function data(Request $request)
    {
        $data = Fakultas::select('*')->orderByDesc("id");
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('search'))) {
                            $search = $request->get('search');
                            $instance->where('nama_fakultas', 'LIKE', "%$search%");
                        }
                    })
                    ->make(true);
    }

    public function datatables()
    {
        $fakultas = Fakultas::select('*');
        return DataTables::of($fakultas)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Fakultas $fakultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('fakultas.edit', compact('fakultas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fakultas' => 'required',
            'kode_fakultas' => 'required',
        ]);

        $fakultas = Fakultas::findOrFail($id);
        $fakultas->update([
            'nama_fakultas' => $request->nama_fakultas,
            'kode_fakultas' => $request->kode_fakultas,
        ]);

        return redirect()->route('fakultas_index')->with('fakultas', 'Fakultas berhasil diperbarui.');
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request){
        // return $request->id;
        $data = Fakultas::find($request->id);
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
