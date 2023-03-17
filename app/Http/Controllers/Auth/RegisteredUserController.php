<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'min:6', 'max:30'],
        ], [
            'name.required' => 'Ce champ est requis',
            'name.max' => 'Le nom doit avoir 100 caractères maximums',
            'email.required' => 'Ce champ est requis',
            'email.email' => 'Le format de l\'email est invalide',
            'email.unique' => 'Cet email existe déjà',
            'email.max' => 'L\'email doit avoir 100 caractères maximums',
            'password.required' => 'Ce champ est requis',
            'password.min' => 'Le mot de passe doit avoir au moins 6 caractères',
            'password.max' => 'Le mot de passe doit avoir 30 caractères maximums'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->created_at = Carbon::now();

            $user->save();

            $notification = array(
                'message' => 'Inscription réussie! Vous pouvez maintenant vous connecter.',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
}
