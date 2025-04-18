<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaModel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Mahasiswa',
            'list'  => ['Home', 'Mahasiswa']
        ];

        $page = (object) [
            'title' => 'Daftar mahasiswa yang Terdaftar pada Classroom'
        ];

        $activeMenu = 'mahasiswa';

        return view('mahasiswa.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data mahasiswa dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $mahasiswas = MahasiswaModel::select('id_mahasiswa', 'nim', 'nama');
        return DataTables::of($mahasiswas)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($mahasiswa) { // menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa .
                    '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create_ajax()
    {
        return view('mahasiswa.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nim'   => 'required|string|max:20|unique:mahasiswa,nim',
                'nama'  => 'required|string|max:255',
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

            MahasiswaModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data Mahasiswa berhasil disimpan',
            ]);
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $mahasiswas = MahasiswaModel::find($id);
        return view('mahasiswa.edit_ajax', ['mahasiswa' => $mahasiswas]);
    }

    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nim'   => 'required|string|max:20',
                'nama'  => 'required|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
            $check = MahasiswaModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data Mahasiswa berhasil diubah',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Mahasiswa tidak ditemukan',
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $mahasiswas = MahasiswaModel::find($id);
        return view('mahasiswa.confirm_ajax', ['mahasiswa' => $mahasiswas]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $mahasiswa = MahasiswaModel::find($id);

            if ($mahasiswa) {
                $mahasiswa->delete();
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
        $mahasiswas = MahasiswaModel::find($id);

        return view('mahasiswa.show_ajax', ['mahasiswa' => $mahasiswas]);
    }    
}
