<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute; // <-- Adicione esta linha
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Account extends Model
{
        use HasFactory;

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


    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function userProfile()
    {
        // Uma Conta pode ter um Perfil de Usuário
        return $this->belongsTo(UserProfile::class);
    }   

    protected function balance(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->initial_balance + ($this->total_receitas ?? 0) - ($this->total_despesas ?? 0),
        );
    }
    public function dashboard()
    {
        // Uma Conta pode estar associada a um Dashboard
        return $this->belongsTo(Dashboard::class);
    }
}
