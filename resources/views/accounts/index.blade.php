<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Minhas Contas
            </h2>
            <a href="{{ route('accounts.create') }}" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700">
                Nova Conta
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nome da Conta</th>
                                <th scope="col" class="px-6 py-3">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-right">Saldo Atual</th>
                                <th scope="col" class="px-6 py-3 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($accounts as $account)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $account->name }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $account->type }}</td>
                                    <td class="px-6 py-4 text-right font-bold 
                                        @if($account->balance > 0) text-green-600 @elseif($account->balance < 0) text-red-600 @endif">
                                        R$ {{ number_format($account->balance, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-4">
                                            {{-- Link de Edição --}}
                                            <a href="{{ route('accounts.edit', $account->id) }}" class="font-medium text-blue-600 hover:underline" title="Editar">
                                                Editar
                                            </a>

                                            {{-- Formulário de Exclusão --}}
                                            <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta conta? Todas as transações associadas também serão perdidas.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 hover:underline" title="Excluir">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        Você ainda não cadastrou nenhuma conta.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>