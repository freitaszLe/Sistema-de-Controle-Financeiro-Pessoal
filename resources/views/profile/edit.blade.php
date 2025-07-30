<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-900 leading-tight">
            {{ __('Perfil do Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Card 1: Informações do Perfil (Nome e Email) --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-200 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Card 2: Seus Dados Pessoais (O novo formulário) --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-200 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-personal-information-form')
                </div>
            </div>

            {{-- Card 3: Atualizar Senha --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-200 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Card 4: Deletar Conta --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-200 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>