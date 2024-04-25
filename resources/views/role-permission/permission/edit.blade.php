<!-- resources/views/edit_prodi.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Fakultas</div>
                    <div class="card-body">
                        <form action="{{ route('permission_update', $permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_fakultas">Nama Permission:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $permission->name }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
