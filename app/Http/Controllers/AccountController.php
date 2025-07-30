<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(): View
    {
        // Busca apenas as contas do usuário logado
        $accounts = Auth::user()->accounts()->get();
        return view('accounts.index', ['accounts' => $accounts]);
    }

    public function create(): View
    {
        return view('accounts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'initial_balance' => 'required|numeric|min:0',
        ]);

        // Associa a nova conta ao usuário logado
        Auth::user()->accounts()->create($validated);

        return redirect()->route('accounts.index')->with('success', 'Conta criada com sucesso.');
    }

    public function edit(Account $account): View
    {
        // Verificação de permissão manual
        if ($account->user_id !== Auth::id()) {
            abort(403);
        }
        return view('accounts.edit', ['account' => $account]);
    }

    public function update(Request $request, Account $account): RedirectResponse
    {
        // Verificação de permissão manual
        if ($account->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'initial_balance' => 'required|numeric|min:0',
        ]);

        $account->update($validated);

        return redirect()->route('accounts.index')->with('success', 'Conta atualizada com sucesso.');
    }

    public function destroy(Account $account): RedirectResponse
    {
        // Verificação de permissão manual
        if ($account->user_id !== Auth::id()) {
            abort(403);
        }

        $account->delete();
        return redirect()->route('accounts.index')->with('success', 'Conta excluída com sucesso.');
    }
}