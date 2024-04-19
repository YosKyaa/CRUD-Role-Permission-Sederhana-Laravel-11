<!-- resources/views/edit_prodi.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Program Studis</div>
                <div class="card-body">
                    <form action="{{ route('prodi_update', $prodi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_prodi">Nama Prodi:</label>
                            <input type="text" name="nama_prodi" id="nama_prodi" class="form-control" value="{{ $prodi->nama_prodi }}">
                        </div>
                        <div class="form-group">
                            <label for="kode_Prodi">Kode Prodi:</label>
                            <input type="text" name="kode_prodi" id="kode_prodi" class="form-control" value="{{ $prodi->kode_prodi }}">
                        </div>
                        <div class="form-group">
                            <label for="fakultas_id">Fakultas:</label>
                            <select name="fakultas_id" id="fakultas_id" class="form-control">
                                @foreach($fakultas as $fakultasItem)
                                    <option value="{{ $fakultasItem->id }}" {{ $prodi->fakultas_id == $fakultasItem->id ? 'selected' : '' }}>{{ $fakultasItem->nama_fakultas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection