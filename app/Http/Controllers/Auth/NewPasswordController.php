<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NewPasswordController extends Controller
{
    /**
     * Show reset password form
     */
    public function create(Request $request, $token = null)
    {
        return view('auth.reset-password')
            ->with([
                'token' => $token,
                'email' => $request->email
            ]);
    }

    /**
     * store ne password
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|max:30',
        ], [
            'email.required' => 'Ce champ est requis',
            'email.email' => 'Le format de l\'email est invalide',
            'email.exists' => 'Cet email n\'existe pas',
            'email.max' => 'L\'email doit avoir 100 caractères maximums',
            'password.required' => 'Ce champ est requis',
            'password.min' => 'Le mot de passe doit avoir au moins 6 caractères',
            'password.max' => 'Le mot de passe doit avoir 30 caractères maximums'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            // check token
            $check_token = DB::table('password_resets')->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();

            if (!$check_token) {

                $notification = array(
                    'message' => 'Ce lien est invalide ou expiré',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            } else {

                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->password)
                ]);

                DB::table('password_resets')->where([
                    'email' => $request->email
                ])->delete();

                $notification = array(
                    'message' => 'Votre mot de passe a été modifié avec succès.',
                    'alert-type' => 'success'
                );

                return redirect()->route('login')->with($notification);
            }
        }
    }
}
