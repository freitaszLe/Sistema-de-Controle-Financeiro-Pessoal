<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adicionar Nova Categoria
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium">Nome da Categoria</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium">Tipo</label>
                                <select name="type" id="type" class="mt-1 block w-full" required>
                                    <option value="">Selecione um tipo</option>
                                    <option value="receita" {{ old('type') == 'receita' ? 'selected' : '' }}>Receita</option>
                                    <option value="despesa" {{ old('type') == 'despesa' ? 'selected' : '' }}>Despesa</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-8 flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg">Salvar Categoria</button>
                            <a href="{{ route('categories.index') }}" class="text-sm">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>