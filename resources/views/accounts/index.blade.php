<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Minhas Contas
            </h2>
            {{-- BOTÃO "ADICIONAR" COM NOVA COR --}}
            <a href="{{ route('accounts.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md">
                + Adicionar Conta
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alerta de sucesso (mantido verde) --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Sucesso</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nome da Conta</th>
                                    <th scope="col" class="px-6 py-3">Tipo</th>
                                    <th scope="col" class="px-6 py-3">Saldo Inicial</th>
                                    <th scope="col" class="px-6 py-3 text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accounts as $account)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $account->name }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $account->type }}</td>
                                        <td class="px-6 py-4 text-gray-800">R$ {{ number_format($account->initial_balance, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4 flex gap-4 justify-end">
                                            {{-- LINK "EDITAR" COM NOVA COR --}}
                                            <a href="{{ route('accounts.edit', $account) }}" class="font-medium text-blue-600 hover:text-blue-800 hover:underline">Editar</a>
                                            <form action="{{ route('accounts.destroy', $account) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta conta?');">
                                                @csrf
                                                @method('DELETE')
                                                {{-- BOTÃO "EXCLUIR" COM NOVA COR --}}
                                                <button type="submit" class="font-medium text-red-500 hover:text-red-700 hover:underline">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Nenhuma conta cadastrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>