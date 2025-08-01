<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{

public function index(): View
{
    // Pega as contas do usuário autenticado e já calcula a soma de receitas e despesas
    // para cada uma usando as otimizações do withSum.
    $accounts = Auth::user()
        ->accounts()
        ->withSum('transactions as total_receitas', 'amount', function ($query) {
            $query->where('type', 'receita');
        })
        ->withSum('transactions as total_despesas', 'amount', function ($query) {
            $query->where('type', 'despesa');
        })
        ->get();

    // Calcula o saldo final para cada conta
    $accounts->each(function ($account) {
        $account->current_balance = $account->initial_balance 
                                    + $account->total_receitas 
                                    - $account->total_despesas;
    });

    return view('dashboard', compact('accounts'));
}


    public function show(): View
    {
        // Pega o dashboard do usuário autenticado
        $dashboard = Auth::user()->dashboard;

        // Passa o dashboard para a view
        return view('dashboard.show', compact('dashboard'));
    }
}