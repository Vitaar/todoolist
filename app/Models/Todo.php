<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','nama_kegiatan','deskripsi','pembuat','tanggal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
