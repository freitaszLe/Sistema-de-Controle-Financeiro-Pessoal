<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users.index', ['users' => $users]);
    }

public function show(User $user)
{

    if ($user->id === Auth::id()) {
        return redirect()->route('admin.users.index')->with('info', 'Para ver seu próprio perfil, use a página de perfil normal.');
    }

    // Carrega as transações do usuário
    $transactions = $user->transactions()->with(['category', 'account'])->latest('date')->get();

    // Calcula o desempenho financeiro
    $totalReceitas = $transactions->where('type', 'receita')->sum('amount');
    $totalDespesas = $transactions->where('type', 'despesa')->sum('amount');
    $saldoFinal = $totalReceitas - $totalDespesas;

    return view('admin.users.show', [
        'user' => $user,
        'transactions' => $transactions->take(10), // Pega as 10 mais recentes para a lista
        'totalReceitas' => $totalReceitas,
        'totalDespesas' => $totalDespesas,
        'saldoFinal' => $saldoFinal,
    ]);
}
}
