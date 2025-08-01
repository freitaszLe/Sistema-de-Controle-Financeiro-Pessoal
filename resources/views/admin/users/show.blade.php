<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Desempenho Financeiro de: {{ $user->name }}
                </h2>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-lg shadow-md">
                &larr; Voltar para Usuários
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Cards de Desempenho --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 border-l-4 border-green-500">
                        <h3 class="text-gray-500 text-sm font-semibold uppercase">Total de Receitas</h3>
                        <p class="text-3xl font-bold mt-2 text-green-600">
                            + R$ {{ number_format($totalReceitas, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 border-l-4 border-red-500">
                        <h3 class="text-gray-500 text-sm font-semibold uppercase">Total de Despesas</h3>
                        <p class="text-3xl font-bold mt-2 text-red-600">
                            - R$ {{ number_format($totalDespesas, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 border-l-4 {{ $saldoFinal >= 0 ? 'border-blue-500' : 'border-orange-500' }}">
                        <h3 class="text-gray-500 text-sm font-semibold uppercase">Saldo Final</h3>
                        <p class="text-3xl font-bold mt-2 {{ $saldoFinal >= 0 ? 'text-blue-600' : 'text-orange-500' }}">
                            R$ {{ number_format($saldoFinal, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Tabela de Últimas Transações --}}
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Últimas 10 Transações</h3>
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Data</th>
                                <th class="px-6 py-3">Descrição</th>
                                <th class="px-6 py-3">Valor (R$)</th>
                                <th class="px-6 py-3">Categoria</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr class="border-b">
                                    <td class="px-6 py-4">{{ $transaction->date->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $transaction->description }}</td>
                                    <td class="px-6 py-4 font-bold {{ $transaction->type === 'receita' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $transaction->type === 'receita' ? '+' : '-' }} R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">{{ $transaction->category->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Este usuário ainda não possui transações.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>