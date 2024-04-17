<!-- resources/views/edit_prodi.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Fakultas</div>
                <div class="card-body">
                    <form action="{{ route('fakultas_update', $fakultas->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_fakultas">Nama Fakultas:</label>
                            <input type="text" name="nama_fakultas" id="nama_fakultas" class="form-control" value="{{ $fakultas->nama_fakultas }}">
                        </div>
                        <div class="form-group">
                            <label for="kode_fakultas">Kode Fakultas:</label>
                            <input type="text" name="kode_fakultas" id="kode_fakultas" class="form-control" value="{{ $fakultas->kode_fakultas }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection