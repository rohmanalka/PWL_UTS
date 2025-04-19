@extends('layouts.template')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('matkul/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah
                    Data</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-striped table-hover" id="table_matkul">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAMA MATAKULIAH</th>
                            <th>NAMA DOSEN</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
            data-keyboard="false" data-width="75%" aria-hidden="true">
        </div>
    @endsection
    @push('css')
    @endpush
    @push('js')
        <script>
            function modalAction(url = '') {
                $('#myModal').load(url, function() {
                    $('#myModal').modal('show');
                });
            }
            $(document).ready(function() {
                var dataMatkul = $('#table_matkul').DataTable({
                    // serverSide: true, jika ingin menggunakan server side processing
                    serverSide: true,
                    ajax: {
                        "url": "{{ url('matkul/list') }}",
                        "dataType": "json",
                        "type": "POST"
                    },
                    columns: [{
                        // nomor urut dari laravel datatable addIndexColumn()
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "nama_matkul",
                        className: "",
                        // orderable: true, jika ingin kolom ini bisa diurutkan
                        orderable: true,
                        // searchable: true, jika ingin kolom ini bisa dicari
                        searchable: true
                    }, {
                        data: "nama_dosen",
                        className: "",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }]
                });
            });
        </script>
    @endpush
