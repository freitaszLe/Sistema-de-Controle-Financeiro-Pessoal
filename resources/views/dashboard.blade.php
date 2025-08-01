<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($accounts as $account)
                    

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform transform hover:-translate-y-1">
                        <div class="p-6">
                            
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                                <h3 class="font-bold text-xl text-gray-800">{{ $account->name }}</h3>
                            </div>

                            
                            <div class="mt-6 text-center">
                                <p class="text-sm text-gray-500">Saldo Atual</p>
                                
                                
                                <p class="text-3xl font-bold 
                                    @if($account->balance > 0) text-green-600
                                    @elseif($account->balance < 0) text-red-600
                                    @else text-gray-700
                                    @endif">
                                    R$ {{ number_format($account->balance, 2, ',', '.') }}
                                </p>
                            </div>

                            
                            <div class="mt-8 pt-4 border-t border-gray-200 text-center">
                                <a href="{{ route('transactions.index', ['account_id' => $account->id]) }}" 
                                   class="font-medium text-blue-600 hover:text-blue-800 transition-colors">
                                    Ver Extrato &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- O que mostrar se o usuário não tiver nenhuma conta --}}
                    <div class="md:col-span-2 lg:col-span-3 bg-white rounded-xl shadow-lg p-8 text-center">
                        <h3 class="text-lg font-semibold text-gray-800">Nenhuma conta encontrada!</h3>
                        <p class="text-gray-500 mt-2">Você precisa criar uma conta antes de ver seu dashboard.</p>
                        
                        <a href="{{ route('accounts.create') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700">
                            Criar minha primeira conta
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>