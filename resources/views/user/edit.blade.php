@extends('layouts.master')
@section('title', $data->name)
@section('breadcrumb-items')
    <span class="text-muted fw-light">Pengaturan / Akun Sistem / </span>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('style')
    <style>

    </style>
@endsection

@section('content')
    <!-- User Profile Content -->
    <div class="row">
        <div class="col-md-12">
            @if (session('msg'))
                <div class="alert alert-primary alert-dismissible" role="alert">
                    {{ session('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card mb-4">
                <h5 class="card-header"><img src="" class="w-40 h-40 rounded-circle"
                        style="width:40px; height:40px;object-fit: cover; margin-right:10px;"> Edit Akun </h5>
                <!-- Account -->
                <hr class="my-0">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            @csrf
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $data->name }}" autofocus />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email"
                                    value="{{ old('email') == null ? (strstr($data->email, $data->id) == false ? $data->email : '') : old('email') }}"
                                    placeholder="Email" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Hak Akses</label>
                                <select class="select2 form-select" multiple="multiple" name="roles[]" id="select2Dark">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $data->hasRole($role->id) ? 'selected' : '' }}>
                                            {{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <a class="btn btn-outline-secondary" href="{{ route('user_index') }}">Kembali</a>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>

    <!--/ User Profile Content -->
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script>
        "use strict";
        $(function() {
            const e = $(".selectpicker"),
                t = $(".select2"),
                c = $(".select2-icons");

            function i(e) {
                return e.id ? "<i class='bx bxl-" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
            }
            e.length && e.selectpicker(), t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Select value",
                    dropdownParent: e.parent()
                })
            }), c.length && c.wrap('<div class="position-relative"></div>').select2({
                templateResult: i,
                templateSelection: i,
                escapeMarkup: function(e) {
                    return e
                }
            })
        });
    </script>
@endsection
