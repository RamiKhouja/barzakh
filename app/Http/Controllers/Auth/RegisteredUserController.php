<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        $this->rememberIntendedUrl($request);

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->rememberIntendedUrl($request);

        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'firstname' => ['string'],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'sex'=> $request->sex
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    private function rememberIntendedUrl(Request $request): void
    {
        $redirectTo = $request->input('redirect_to');

        if (! $redirectTo) {
            return;
        }

        $path = parse_url($redirectTo, PHP_URL_PATH) ?? '';
        $host = parse_url($redirectTo, PHP_URL_HOST);
        $isRelativePath = Str::startsWith($redirectTo, '/');
        $isSameHost = $host && $host === $request->getHost();

        if (! $isRelativePath && ! $isSameHost) {
            return;
        }

        if (in_array($path, ['/login', '/register'], true)) {
            return;
        }

        $request->session()->put('url.intended', $redirectTo);
    }
}
