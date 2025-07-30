<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adicionar Nova Conta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    {{-- Exibição de Erros de Validação --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Houve alguns problemas com os dados informados.</span>
                        </div>
                    @endif

                    <form action="{{ route('accounts.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            {{-- Nome da Conta --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nome da Conta</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Ex: Conta Corrente BB, Carteira" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            {{-- Tipo de Conta --}}
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Conta</label>
                                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">Selecione um tipo</option>
                                    <option value="Conta Corrente" {{ old('type') == 'Conta Corrente' ? 'selected' : '' }}>Conta Corrente</option>
                                    <option value="Poupança" {{ old('type') == 'Poupança' ? 'selected' : '' }}>Poupança</option>
                                    <option value="Carteira" {{ old('type') == 'Carteira' ? 'selected' : '' }}>Carteira</option>
                                    <option value="Cartão de Crédito" {{ old('type') == 'Cartão de Crédito' ? 'selected' : '' }}>Cartão de Crédito</option>
                                    <option value="Investimentos" {{ old('type') == 'Investimentos' ? 'selected' : '' }}>Investimentos</option>
                                    <option value="Outro" {{ old('type') == 'Outro' ? 'selected' : '' }}>Outro</option>
                                </select>
                            </div>

                            {{-- Saldo Inicial --}}
                            <div>
                                <label for="initial_balance" class="block text-sm font-medium text-gray-700">Saldo Inicial (R$)</label>
                                <input type="number" name="initial_balance" id="initial_balance" value="{{ old('initial_balance', 0.00) }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <p class="mt-1 text-xs text-gray-500">Para cartões de crédito, você pode deixar 0 e lançar a fatura como uma despesa depois.</p>
                            </div>
                        </div>

                        {{-- Botões de Ação --}}
                        <div class="mt-8 flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md">Salvar Conta</button>
                            <a href="{{ route('accounts.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>