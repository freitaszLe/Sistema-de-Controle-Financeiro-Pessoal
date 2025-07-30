<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // DENTRO DE ProfileController.php

    public function updatePersonal(Request $request): RedirectResponse
    {
        // Valide os dados
        $validated = $request->validate([
            'full_name' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'cpf' => ['nullable', 'string', 'max:14'], // Adicione regras de validação de CPF se necessário
            'nationality' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'gender' => ['nullable', 'string', 'max:10'],
            'marital_status' => ['nullable', 'string', 'max:10'],
        ]);

        // Salve os dados no perfil do usuário
        $request->user()->profile->update($validated);

        // Redirecione de volta para a página de edição de perfil
        return Redirect::route('profile.edit')->with('status', 'personal-profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
