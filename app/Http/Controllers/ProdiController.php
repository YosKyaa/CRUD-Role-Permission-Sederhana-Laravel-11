<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->isMethod('POST')) { 
            $this->validate($request, [ 
                'kode_prodi'    => ['required'],
                'nama_prodi'    => ['required'],
                'fakultas_id' => 'required|exists:fakultas,id',
            ]);
            $new = Prodi::create([
                'kode_prodi'=> $request->kode_prodi,
                'nama_prodi'=> $request->nama_prodi,
                'fakultas_id' => $request->fakultas_id,
            ]);
            if($new){
                return redirect()->route('prodi_index')->with('msg','Data atas ('.$request->nama_prodi.') dengan '.$request->kode_prodi.' BERHASIL ditambahkan!');
            }
        }
            $fakultas = Fakultas::select("*")->get();
            $prodi = Prodi::select("*")->get();
            // dd($data);
            return view('prodi.index', compact('fakultas','prodi'));
        }

        public function data(Request $request){
            $data = Prodi::with('fakultas')->select('*')->orderBy("id");
                return DataTables::of($data)
                        ->filter(function ($instance) use ($request) {
                            if (!empty($request->get('select_fakultas'))) {
                                $instance->where("fakultas_id", $request->get('select_fakultas'));
                            }
                            if (!empty($request->get('search'))) {
                                $search = $request->get('search');
                                $instance->where('nama_prodi', 'LIKE', "%$search%");
                            }
                        })->make(true);
        }
    /**
     * Show the form for creating a new resource.
     */
    public function datatables()
    {
        $fakultas = Prodi::select('*');
        return DataTables::of($fakultas)->make(true);
    }
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        $fakultas = Fakultas::all();
        return view('prodi.edit', compact('prodi', 'fakultas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_prodi' => 'required',
            'kode_prodi' => 'required',
            'fakultas_id' => 'required|exists:fakultas,id',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update([
            'nama_prodi' => $request->nama_prodi,
            'kode_prodi' => $request->kode_prodi,
            'fakultas_id' => $request->fakultas_id,
        ]);

        return redirect()->route('prodi_index')->with('prodi', 'Prodi berhasil diperbarui.');
    }

    public function delete(Request $request){
        $data = Prodi::find($request->id);
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
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        //
    }
}
