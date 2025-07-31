<x-app-layout>
    {{-- CABEÇALHO DA PÁGINA: Título e botão principal --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Minhas Transações
            </h2>
            <a href="{{ route('transactions.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                <span>Nova Transação</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- CARD PRINCIPAL QUE ENGLOBA FILTROS E TABELA --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                {{-- SEÇÃO DE FILTROS --}}
                <div class="px-6 py-4 border-b border-gray-200">
                    <form action="{{ route('transactions.index') }}" method="GET">
                        <div class="flex flex-col md:flex-row gap-4">
                            
                            {{-- Campo de Busca (ocupa o máximo de espaço) --}}
                            <div class="flex-grow">
                                <label for="search" class="sr-only">Buscar</label>
                                <input type="text" name="search" id="search" placeholder="Buscar por descrição..." 
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                       value="{{ request('search') }}">
                            </div>

                            {{-- Filtros de Ordenação (agrupados) --}}
                            <div class="flex items-center gap-4">
                                <select name="sort_by" class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Ordenar por</option>
                                    <option value="date" @selected(request('sort_by') == 'date')>Data</option>
                                    <option value="amount" @selected(request('sort_by') == 'amount')>Valor</option>
                                </select>

                                <select name="sort_order" class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="desc" @selected(request('sort_order', 'desc') == 'desc')>Descendente</option>
                                    <option value="asc" @selected(request('sort_order') == 'asc')>Ascendente</option>
                                </select>

                                {{-- Botões de Ação do Formulário --}}
                                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">Filtrar</button>
                                <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Limpar</a>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- TABELA DE RESULTADOS --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Descrição</th>
                                <th scope="col" class="px-6 py-3">Categoria</th>
                                <th scope="col" class="px-6 py-3 text-center">Data</th>
                                <th scope="col" class="px-6 py-3 text-right">Valor</th>
                                <th scope="col" class="px-6 py-3 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $transaction->description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $transaction->category->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">{{ $transaction->date->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-right font-bold {{ $transaction->type === 'receita' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $transaction->type === 'receita' ? '+' : '-' }} R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-4">
                                            <a href="{{ route('transactions.edit', $transaction) }}" class="font-medium text-blue-600 hover:underline">Editar</a>
                                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 hover:underline">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        Nenhuma transação encontrada.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINAÇÃO --}}
                @if ($transactions->hasPages())
                    <div class="p-6 border-t border-gray-200">
                        {{ $transactions->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>