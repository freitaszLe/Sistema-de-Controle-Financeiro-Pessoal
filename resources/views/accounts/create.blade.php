<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Criar Nova Conta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <form action="{{ route('accounts.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nome da Conta</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                       placeholder="Ex: Banco do Brasil, Carteira" required>
                                @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Conta</label>
                                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="Conta Corrente" @selected(old('type') == 'Conta Corrente')>Conta Corrente</option>
                                    <option value="Poupança" @selected(old('type') == 'Poupança')>Poupança</option>
                                    <option value="Investimentos" @selected(old('type') == 'Investimentos')>Investimentos</option>
                                    <option value="Carteira" @selected(old('type') == 'Carteira')>Carteira</option>
                                    <option value="Outros" @selected(old('type') == 'Outros')>Outros</option>
                                </select>
                                @error('type')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>

                            <div>
                                <label for="initial_balance" class="block text-sm font-medium text-gray-700">Saldo Inicial (R$)</label>
                                <input type="number" step="0.01" name="initial_balance" id="initial_balance" value="{{ old('initial_balance', '0.00') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @error('initial_balance')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('accounts.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700">
                                Salvar Conta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>