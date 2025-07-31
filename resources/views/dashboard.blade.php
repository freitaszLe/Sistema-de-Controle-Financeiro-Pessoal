<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-150 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <h3 class="text-lg font-semibold mb-4">Bem-vindo, {{ Auth::user()->name }}!</h3>
                    <p class="mb-4">Aqui você pode gerenciar suas transações financeiras, contas e categorias.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white dark:bg-gray-200 p-4 rounded-lg shadow">
                            <h4 class="font-semibold mb-2">Minhas Contas</h4>
                            <ul class="list-disc pl-5">             
                                @foreach(Auth::user()->accounts as $account)
                                    <li>{{ $account->name }} - R$ {{ number_format($account->balance, 2, ',', '.') }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="bg-white dark:bg-gray-200 p-4 rounded-lg shadow">
                            <h4 class="font-semibold mb-2">Minhas Categorias</h4>
                            <ul class="list-disc pl-5">
                                @foreach(Auth::user()->categories as $category)         
                                    <li>{{ $category->name }} ({{ $category->type }})</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="bg-white dark:bg-gray-200 p-4 rounded-lg shadow">
                            <h4 class="font-semibold mb-2">Minhas Transações Recentes</h4>
                            <ul class="list-disc pl-5">
                                @foreach(Auth::user()->transactions->sortByDesc('date')->take(5) as $transaction)
                                    <li>{{ $transaction->description }} - R$ {{ number_format($transaction->amount, 2, ',', '.') }} ({{ $transaction->date->format('d/m/Y') }})</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
