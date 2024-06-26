@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
@endsection

@section('style')
    <style>
        table.dataTable tbody td {
            vertical-align: middle;
        }

        table.dataTable td:nth-child(2) {
            max-width: 150px;
        }

        table.dataTable td {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            word-wrap: break-word;
        }
    </style>
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <br />
    <h1 align="left">Pemission-Roles Management</h1>
    <br />

    <div class="card">
        <div>
            <a href="../permission/" class="btn btn-primary">Edit Permission</a>
        </div>
        <div class="card-datatable table-responsive">
            <div class="card-header flex-column flex-md-row pb-0">
                <table class="table table-hover table-sm" id="datatable" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    @endsection

    @section('script')
        <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables/datatables-bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables/datatables.responsive.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables/responsive.bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables/datatables.checkboxes.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables/datatables-buttons.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables/buttons.bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>
        <script>
            "use strict";
            setTimeout(function() {
                (function($) {
                    "use strict";
                    $(".select2").select2({
                        allowClear: true,
                        minimumResultsForSearch: 7
                    });
                })(jQuery);
            }, 350);
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#datatable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    language: {
                        searchPlaceholder: 'Cari..',
                        url: "{{ asset('assets/vendor/libs/datatables/id.json') }}"
                    },
                    ajax: {
                        url: "{{ route('role-permission.role.data') }}",
                        data: function(d) {
                            d.search = $('input[type="search"]').val()
                        },
                    },
                    columnDefs: [{
                        "defaultContent": "-",
                        "targets": "_all"
                    }],
                    columns: [{
                            render: function(data, type, row, meta) {
                                var no = (meta.row + meta.settings._iDisplayStart + 1);
                                return no;
                            },
                            className: "text-center",
                            "orderable": false
                        },
                        {
                            render: function(data, type, row, meta) {
                                var html = row.name;
                                return html;
                            }
                        },
                        {
                            render: function(data, type, row, meta) {
                                var x =
                                    '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">';
                                if (row.permissions != null) {
                                    row.permissions.forEach((e) => {
                                        x += '<li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="' +
                                            e.name +
                                            '"><i class="badge rounded-pill bg-primary"  style="font-size:8pt;">' +
                                            e.name +
                                            '</i></li>';
                                    });
                                }
                                var y = "</ul>";
                                return x + y;
                            },
                        },
                        {
                            render: function(data, type, row, meta) {
                                var html =
                                    `<a class=" text-success" title="Edit" href="{{ url('/role/edit/` + row.id + `') }}"><i class="bx bxs-edit"></i></a> 
                            <a class=" text-danger" title="Hapus" style="cursor:pointer" onclick="DeleteId(\'` + row
                                    .id + `\',\'` + row.name +
                                    `\')" ><i class="bx bx-trash"></i></a>`;
                                return html;
                            },
                            "orderable": false,
                            className: "text-md-center"
                        }
                    ]
                });
            });

            function DeleteId(id, data) {
                swal({
                        title: "Apa kamu yakin?",
                        text: "Setelah dihapus, data (" + data + ") tidak dapat dipulihkan!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{ route('delete_fakultas') }}",
                                type: "DELETE",
                                data: {
                                    "id": id,
                                    "_token": $("meta[name='csrf-token']").attr("content"),
                                },
                                success: function(data) {
                                    // alert(data);
                                    if (data['success']) {
                                        swal(data['message'], {
                                            icon: "success",
                                        });
                                        $('#datatable').DataTable().ajax.reload();
                                    } else {
                                        swal(data['message'], {
                                            icon: "error",
                                        });
                                    }
                                }
                            })
                        }
                    })
            }
        </script>
    @endsection
