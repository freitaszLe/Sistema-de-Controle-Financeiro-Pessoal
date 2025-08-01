<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adicionar Nova Transação
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Tipo de Transação --}}
                            <div class="md:col-span-2">
                                <label for="type" class="block text-sm font-medium">Tipo</label>
                                <select name="type" id="type" class="mt-1 block w-full" required>
                                    <option value="despesa">Despesa</option>
                                    <option value="receita">Receita</option>
                                </select>
                            </div>

                            {{-- Descrição --}}
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium">Descrição</label>
                                <input type="text" name="description" id="description" value="{{ old('description') }}" class="mt-1 block w-full" required>
                            </div>

                            {{-- Valor --}}
                            <div>
                                <label for="amount" class="block text-sm font-medium">Valor (R$)</label>
                                <input type="number" name="amount" id="amount" value="{{ old('amount') }}" step="0.01" class="mt-1 block w-full" required>
                            </div>

                            {{-- Data --}}
                            <div>
                                <label for="date" class="block text-sm font-medium">Data</label>
                                <input type="date" name="date" id="date" value="{{ old('date', now()->format('Y-m-d')) }}" class="mt-1 block w-full" required>
                            </div>

                            {{-- Conta --}}
                            <div>
                                <label for="account_id" class="block text-sm font-medium">Conta</label>
                                <select name="account_id" id="account_id" class="mt-1 block w-full" required>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Categoria --}}
                            <div>
                                <label for="category_id" class="block text-sm font-medium">Categoria</label>
                                <select name="category_id" id="category_id" class="mt-1 block w-full" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }} ({{$category->type}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-8 flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg">Salvar Transação</button>
                            <a href="{{ route('transactions.index') }}" class="text-sm">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>