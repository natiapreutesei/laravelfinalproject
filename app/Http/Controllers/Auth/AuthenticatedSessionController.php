<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    // Method to handle user login
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email', // Email is required and must be in email format
            'password' => 'required', // Password is required
        ]);

        // Attempt to authenticate the user with the provided credentials
        if (! Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // If authentication fails, throw a validation exception with an error message
            throw ValidationException::withMessages([
                'email' => __('auth.failed'), // 'auth.failed' is a translation key for the failed login message
            ]);
        }

        // Regenerate the session to prevent session fixation attacks
        $request->session()->regenerate();

        // Redirect the user to the intended URL after login or default to the home route
        return redirect()->intended(route('home'));
    }

    // Method to handle user logout
    public function destroy(Request $request)
    {
        // Logout the user from the 'web' guard
        Auth::guard('web')->logout();

        // Invalidate the session to prevent session reuse
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect the user to the homepage after logout
        return redirect('/');
    }
}

