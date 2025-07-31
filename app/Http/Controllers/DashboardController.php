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
        // Pega as contas do usuário autenticado
         $accounts = Auth::user()
        ->accounts()
        ->withSum(['transactions as total_receitas' => fn ($query) => $query->where('type', 'receita')], 'amount')
        ->withSum(['transactions as total_despesas' => fn ($query) => $query->where('type', 'despesa')], 'amount')
        ->get();


        $accounts->each(function ($account) {
            $account->balance = $account->balance;
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