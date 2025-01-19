<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User ::class],
            'is_going' => ['required'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required'],
            // 'tshirt_size' => ['required'],
            // 'room' => ['required', 'in:single,couple'], // Ensure room is required and valid
        ]);
    
        // Map room selection to database columns
        // $singleRoom = ($request->room === 'single') ? 1 : 0;
        // $coupleRoom = ($request->room === 'couple') ? 1 : 0;
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            // 'tshirt_size' => $request->tshirt_size,
            'opinion' => $request->opinion,
            'is_going' => $request->is_going,
            // 'single_room' => $singleRoom, // Set single_room based on selection
            // 'couple_room' => $coupleRoom, // Set couple_room based on selection


            'm_size' => $request->m_size,
            'l_size' => $request->l_size,
            'xl_size' => $request->xl_size,
            'xxl_size' => $request->xxl_size,
            'single_room' => $request->single_room,
            'couple_room' => $request->couple_room,
            'additional_members' => $request->additional_members,

        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(route('dashboard', absolute: false));
    }
}
