<div class="w-64 h-screen bg-gray-900 text-white flex flex-col fixed top-0 left-0 border-r border-gray-700">
    <div class="px-6 h-16 flex items-center justify-center border-b border-gray-700">
        <h2 class="font-bold text-xl text-center text-gray-200">Admin FinTrack</h2>
    </div>
    <nav class="flex-grow px-4 py-4">
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.users.*') ? 'bg-gray-700 text-white' : '' }}">
            <span class="mr-3">👥</span>
            Gerenciar Usuários
        </a>
    </nav>
</div>
<div class="w-64"></div>