<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AvatarImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

/**
 * Resource controller for user accounts.
 *
 * Registered with Route::resource('users', UserController::class)
 * inside the `auth` middleware group in routes/web.php.
 */
class UserController extends Controller
{
    /** GET /users */
    public function index(): View
    {
        $users = User::query()->orderBy('full_name')->paginate(10);

        return view('users.index', compact('users'));
    }

    /** GET /users/create */
    public function create(): View
    {
        return view('users.create');
    }

    /** POST /users */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:100', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'User account created successfully.');
    }

    /** GET /users/{user} */
    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    /** GET /users/{user}/edit */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /** PUT/PATCH /users/{user} */
    public function update(
        Request $request,
        User $user,
        AvatarImageService $avatarImageService
    ): RedirectResponse {
        $validated = $request->validate([
            'username' => [
                'required', 'string', 'max:100',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            // Leave blank to keep the current password.
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        unset($validated['avatar']);

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            $newAvatarPath = $avatarImageService->prepareAndStore(
                $request->file('avatar')
            );

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $validated['avatar'] = $newAvatarPath;
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User account updated successfully.');
    }

    /** DELETE /users/{user} */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->is($user)) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete the account you are currently logged in with.');
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User account deleted successfully.');
    }
}
