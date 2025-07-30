<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-900">
            Dados Pessoais
        </h2>
        <p class="mt-1 text-sm text-gray-900 dark:text-gray-900">
            Complete seu perfil com suas informações pessoais.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update.personal') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="full_name" value="Nome Completo" />
            <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name', $user->profile?->full_name)" />
            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
        </div>

        <div>
            <x-input-label for="birth_date" value="Data de Nascimento" />
            <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $user->profile?->birth_date)" />
            <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
        </div>

        <div>
            <x-input-label for="cpf" value="CPF" />
            <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block w-full" :value="old('cpf', $user->profile?->cpf)" />
            <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
        </div>

        <div>
            <x-input-label for="nationality" value="Nacionalidade" />
            <x-text-input id="nationality" name="nationality" type="text" class="mt-1 block w-full" :value="old('nationality', $user->profile?->nationality)" />
            <x-input-error class="mt-2" :messages="$errors->get('nationality')" />  
        </div>

        <div>
            <x-input-label for="gender" value="Gênero" />
            <x-text-input id="gender" name="gender" type="text" class="mt-1 block w-full" :value="old('gender', $user->profile?->gender)" />
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="marital_status" value="Estado Civil" />
            <x-text-input id="marital_status" name="marital_status" type="text" class="mt-1 block w-full" :value="old('marital_status', $user->profile?->marital_status)" />
            <x-input-error class="mt-2" :messages="$errors->get('marital_status')" />
        </div>

        <div>
            <x-input-label for="postal_code" value="CEP" />
            <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $user->profile?->postal_code)" />
            <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'personal-profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>