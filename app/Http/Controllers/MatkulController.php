<?php

namespace App\Http\Controllers;

use App\Models\MatkulModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MatkulController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Matakuliah',
            'list'  => ['Home', 'Matakuliah']
        ];

        $page = (object) [
            'title' => 'Daftar Matakuliah yang Terdaftar pada Classroom'
        ];

        $activeMenu = 'matkul';

        return view('matkul.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data matkul dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $matkuls = MatkulModel::select('id_matkul', 'nama_matkul', 'nama_dosen');
        return DataTables::of($matkuls)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($matkul) { // menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\'' . url('/matkul/' . $matkul->id_matkul .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/matkul/' . $matkul->id_matkul .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/matkul/' . $matkul->id_matkul .
                    '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create_ajax()
    {
        return view('matkul.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_matkul'   => 'required|string|max:100',
                'nama_dosen'    => 'required|string|max:100',
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // pesan error validasi
                ]);
            }

            MatkulModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data Matakuliah berhasil disimpan',
            ]);
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $matkuls = MatkulModel::find($id);
        return view('matkul.edit_ajax', ['matkul' => $matkuls]);
    }

    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_matkul'   => 'required|string|max:100',
                'nama_dosen'    => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
            $check = MatkulModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data Matakuliah berhasil diubah',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Matakuliah tidak ditemukan',
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $matkuls = MatkulModel::find($id);
        return view('matkul.confirm_ajax', ['matkul' => $matkuls]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $matkul = MatkulModel::find($id);

            if ($matkul) {
                $matkul->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function show_ajax(string $id)
    {
        $matkuls = MatkulModel::find($id);

        return view('matkul.show_ajax', ['matkul' => $matkuls]);
    }    
}
