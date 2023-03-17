<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisteredController extends Controller
{
    public function save(Request $request)
    {

        // print_r($_POST);

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
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->created_at = Carbon::now();

            $user->save();

            return response()->json([
                'status' => 200,
                'messages' => 'Inscription réussie! Vous pouvez maintenant vous connecter'
            ]);
        }
    }


    public function login(Request $request)
    {

        // print_r($_POST);

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:100'],
            'password' => ['required', 'min:6', 'max:30'],
        ], [
            'email.required' => 'Ce champ est requis',
            'email.email' => 'Le format de l\'email est invalide',
            'email.max' => 'L\'email doit avoir 100 caractères maximums',
            'password.required' => 'Ce champ est requis',
            'password.min' => 'Le mot de passe doit avoir au moins 6 caractères',
            'password.max' => 'Le mot de passe doit avoir 30 caractères maximums'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {

            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('loggedInUser', $user->id);

                    $role = $user->role;
                    // print_r($user);
                    # gestion des chemins url selon le role
                    // $url = '';
                    // if ($request->user()->role === 'admin') {
                    //     $url = 'admin/dashboard';
                    // } elseif ($request->user()->role === 'vendor') {
                    //     $url = 'vendor/dashboard';
                    // } elseif ($request->user()->role === 'user') {
                    //     $url = '/dashboard';
                    // }

                    // return redirect()->intended($url)->with($notification);
                    return response()->json([
                        'status' => 200,
                        'messages' => 'success',
                        'role' => $role
                    ]);
                } else {
                    return response()->json([
                        'status' => 401,
                        'messages' => 'E-mail ou mot de passe incorrect!'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 401,
                    'messages' => 'Utilisateur non trouvé!'
                ]);
            }
        }
    }


    public function profile()
    {
        return view('dashboard');
        // $request->authenticate();

        // $request->session()->regenerate();

        // $notification = array(
        //     'message' => 'Heureux de vous revoir!',
        //     'alert-type' => 'success'
        // );

        // # gestion des chemins url selon le role
        // $url = '';
        // if ($request->user()->role === 'admin') {
        //     $url = 'admin/dashboard';
        // } elseif ($request->user()->role === 'vendor') {
        //     $url = 'vendor/dashboard';
        // } elseif ($request->user()->role === 'user') {
        //     $url = '/dashboard';
        // }

        // return redirect()->intended($url)->with($notification);
    }


    public function logout()
    {
        if (session()->has('loggedInUser')) {
            session()->pull('loggedInUser');
            return redirect('/');
        }
    }
}
