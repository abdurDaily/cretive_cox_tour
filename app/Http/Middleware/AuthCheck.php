<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Registration;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateUser 
{
    public function handle(Request $request, Closure $next): Response
    {
        $email = $request->email;
        $password = $request->password;

        // Find the user by email
        $user = Registration::where('email', $email)->first();

        // Check if the user exists and the password is correct
        if ($user && Hash::check($password, $user->password)) {
            // User is authenticated, proceed to the next middleware/route handler
            return $next($request);
        }

        // User is not authenticated, redirect to the login page with an error message
        return redirect()->route('login.index')->with('error', 'Invalid email or password');
    }
}
