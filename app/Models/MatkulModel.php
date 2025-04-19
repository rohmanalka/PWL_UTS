<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulModel extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $primaryKey = 'id_matkul';
    protected $fillable = ['id_matkul', 'nama_matkul', 'nama_dosen'];
}
