<x-admin-layout> {{-- USA O NOVO LAYOUT DE ADMIN --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gerenciamento de Usuários
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nome</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Data de Cadastro</th>
                                <th scope="col" class="px-6 py-3 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.users.show', $user) }}" class="font-medium text-blue-600 hover:underline">
                                            Ver Desempenho
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Nenhum usuário cadastrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>