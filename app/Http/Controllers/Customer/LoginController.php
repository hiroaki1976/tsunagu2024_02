<?php

namespace App\Http\Controllers\Customer;

use App\Http\Requests\CustomerLoginRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * ログイン画面
     */
    public function create(): View
    {
        return view('customer.auth.login');
    }

    /**
     * ログイン
     */
    public function store(CustomerLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('customer.dashboard'));
    }

    /**
     * ログアウト
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('welcome');
    }
}
