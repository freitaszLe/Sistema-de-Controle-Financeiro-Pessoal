<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'type',
    ];

    public function user()
    {
        // Uma Categoria pertence a um Usuário
        return $this->belongsTo(User::class);
    }

 // public function transactions()
  //{
        // Uma Categoria pode ter muitas Transações
  //    return $this->hasMany(Transaction::class);
  //}
}
