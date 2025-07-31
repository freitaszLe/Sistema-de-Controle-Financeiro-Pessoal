<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $fillable = [
        'user_id',
        'total_balance',
        'total_income',
        'total_expense',
        'last_transaction_date',
    ];

    public function user()
    {
        // Um Dashboard pertence a um Usuário
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        // Um Dashboard pode ter muitas Transações
        return $this->hasMany(Transaction::class);
    }

    public function categories()
    {
        // Um Dashboard pode ter muitas Categorias
        return $this->hasMany(Category::class);
    }

    public function accounts()
    {
        // Um Dashboard pode ter muitas Contas
        return $this->hasMany(Account::class);
    }

    public function accessors()
    {
        // Acessores para calcular totais e outras informações
        return [
            'total_balance' => function () {
                return $this->accounts->sum('initial_balance');
            },
            'total_income' => function () {
                return $this->transactions->where('type', 'income')->sum('amount');
            },
            'total_expense' => function () {
                return $this->transactions->where('type', 'expense')->sum('amount');
            },
        ];
    }
    
}
