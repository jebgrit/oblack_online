<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{
    /**
     * Show forgot password form
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Sent reset link
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:100', 'exists:users,email'],
        ], [
            'email.required' => 'Ce champ est requis',
            'email.email' => 'Le format de l\'email est invalide',
            'email.exists' => 'Cet email n\'existe pas',
            'email.max' => 'L\'email doit avoir 100 caractères maximums',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $token = Str::random(64);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $action_link = route('password.reset', ['token' => $token, 'email' => $request->email]);

            $body = 'Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte.
         Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe';

            Mail::send(
                'auth.forgot-password-email',
                [
                    'action_link' => $action_link,
                    'body' => $body
                ],
                function ($message) use ($request) {
                    $message->from('ne-pas-repondre@support.com', 'support');
                    $message->to($request->email)
                        ->subject('Réinitialiser le mot de passe');
                }
            );


            $notification = array(
                'message' => 'Un mail contenant le lien de réinitialisation du mot de passe vient de vous être envoyé',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);
        }
    }
}
