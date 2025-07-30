<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Conta: {{ $account->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <form action="{{ route('accounts.update', $account) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Informa ao Laravel que é uma atualização --}}

                        <div class="space-y-6">
                            {{-- Nome da Conta --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nome da Conta</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $account->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            {{-- Tipo de Conta --}}
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Conta</label>
                                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="Conta Corrente" {{ old('type', $account->type) == 'Conta Corrente' ? 'selected' : '' }}>Conta Corrente</option>
                                    <option value="Poupança" {{ old('type', $account->type) == 'Poupança' ? 'selected' : '' }}>Poupança</option>
                                    <option value="Carteira" {{ old('type', $account->type) == 'Carteira' ? 'selected' : '' }}>Carteira</option>
                                    <option value="Cartão de Crédito" {{ old('type', $account->type) == 'Cartão de Crédito' ? 'selected' : '' }}>Cartão de Crédito</option>
                                    <option value="Investimentos" {{ old('type', $account->type) == 'Investimentos' ? 'selected' : '' }}>Investimentos</option>
                                    <option value="Outro" {{ old('type', $account->type) == 'Outro' ? 'selected' : '' }}>Outro</option>
                                </select>
                            </div>

                            {{-- Saldo Inicial --}}
                            <div>
                                <label for="initial_balance" class="block text-sm font-medium text-gray-700">Saldo Inicial (R$)</label>
                                <input type="number" name="initial_balance" id="initial_balance" value="{{ old('initial_balance', $account->initial_balance) }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                        </div>

                        {{-- Botões de Ação --}}
                        <div class="mt-8 flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md">Atualizar Conta</button>
                            <a href="{{ route('accounts.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>