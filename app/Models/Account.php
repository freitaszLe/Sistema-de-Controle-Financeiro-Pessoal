<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'initial_balance',
    ];

    public function user()
    {
        // Uma Conta pertence a um Usuário
        return $this->belongsTo(User::class);
    }

//    public function transactions()
//    {
        // Uma Conta pode ter muitas Transações
//        return $this->hasMany(Transaction::class);
//    }
}
