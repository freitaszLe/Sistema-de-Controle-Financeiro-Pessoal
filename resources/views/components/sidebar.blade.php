<div class="w-64 h-screen bg-gray-800 text-white flex flex-col fixed top-0 left-0">
    {{-- Logo --}}
    <div class="px-6 h-16 flex items-center justify-center border-b border-gray-700">
        <h2 class="font-bold text-xl text-center text-gray-200">FinTrack</h2>
    </div>

    {{-- Menu de Navegação --}}
    <nav class="flex-grow px-4 py-4">
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : '' }}">
            <span class="mr-3">📊</span>
            Dashboard
        </a>
        <a href="{{ route('accounts.index') }}"
           class="flex items-center px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('accounts.*') ? 'bg-gray-700 text-white' : '' }}">
            <span class="mr-3">💳</span>
            Minhas Contas
        </a>
        <a href="{{ route('categories.index') }}"
            class="flex items-center px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('categories.*') ? 'bg-gray-700 text-white' : '' }}">
            <span class="mr-3">🏷️</span>
            Categorias
        </a>
        <a href="{{ route('transactions.index') }}"
            class="flex items-center px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('transactions.*') ? 'bg-gray-700 text-white' : '' }}">
            <span class="mr-3">💸</span>
            Lançamentos
        </a>
    </nav>
</div>

<div class="w-64"></div>