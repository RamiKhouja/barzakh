<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $this->rememberIntendedUrl($request);

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $this->rememberIntendedUrl($request);

        $request->authenticate();

        $request->session()->regenerate();
        
        $user = auth()->user();

        if (Auth::user()->role === 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        //return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
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
