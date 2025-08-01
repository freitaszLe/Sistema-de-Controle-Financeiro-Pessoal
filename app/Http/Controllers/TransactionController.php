<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Account;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class TransactionController extends Controller
{
    public function index(Request $request): View
    {
    // Inicia a query base
    $query = Auth::user()
                ->transactions()
                ->with(['account', 'category']);

    // Aplica filtros de busca e de data
    if ($request->filled('search')) {
        $query->where('description', 'like', '%' . $request->search . '%');
    }
    if ($request->filled('date_from')) {
        $query->whereDate('date', '>=', $request->date_from);
    }
    if ($request->filled('date_to')) {
        $query->whereDate('date', '<=', $request->date_to);
    }
    
    // ... outros filtros que você queira adicionar (type, account_id, etc.)

    // Aplica a ordenação
    if ($request->filled('sort_by')) {
        // Usa a ordenação do request se ela for fornecida
        $query->orderBy($request->sort_by, $request->sort_order ?? 'desc');
    } else {
        // Caso contrário, usa a ordenação padrão (mais recente primeiro)
        $query->latest('date');
    }

    // Executa a query com paginação, mantendo os filtros nos links
    $transactions = $query->paginate(15)->withQueryString();

    return view('transactions.index', compact('transactions'));
    }
    public function create(): View
    {
    $accounts = Auth::user()->accounts()->get();
    $categories = Auth::user()->categories()->get();

    return view('transactions.create', [
        'accounts' => $accounts,
        'categories' => $categories,
    ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:receita,despesa',
            'date' => 'required|date',
            'account_id' => 'required|exists:accounts,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Auth::user()->transactions()->create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transação salva com sucesso.');
    }

    public function edit(Transaction $transaction): View
    {
        // Verificação de permissão manual
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $accounts = Auth::user()->accounts()->get();
        $categories = Auth::user()->categories()->get();

        return view('transactions.edit', [
            'transaction' => $transaction,
            'accounts' => $accounts,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
        // Verificação de permissão manual
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:receita,despesa',
            'date' => 'required|date',
            'account_id' => 'required|exists:accounts,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transação atualizada com sucesso.');
    }

    public function destroy(Transaction $transaction): RedirectResponse
    {
        // Verificação de permissão manual
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transação excluída com sucesso.');
    }

    // Os métodos edit, update e destroy seguiriam o mesmo padrão...
}