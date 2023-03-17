<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function userDashboard()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('index', compact('userData'));
    }






    public function updateProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['nullable', 'numeric'],
            'address' => ['required', 'max:100'],
            'city' => ['required', 'max:100'],
            'zip_code' => ['required', 'max:5'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        ], [
            'name.required' => 'Ce champ est requis',
            'name.max' => 'Le nom doit avoir 100 caractères maximums',

            'email.required' => 'Ce champ est requis',
            'email.email' => 'Le format de l\'email est invalide',
            'email.max' => 'L\'email doit avoir 50 caractères maximums',

            'phone.numeric' => 'Le numéro ne doit contenir que des chiffres sans espaces',
            'address.required' => 'Ce champ est requis',
            'address.max' => 'L\'adresse doit avoir 100 caractères maximums',

            'city.required' => 'Ce champ est requis',
            'city.max' => 'Le nom de la ville doit avoir 100 caractères maximums',
            'zip_code.required' => 'Ce champ est requis',
            'zip_code.max' => 'Le code postal doit avoir 5 caractères maximums',
            'image.image' => 'Le format des images acceptés est jpeg, png ou jpg',
            'image.max' => 'L\'image doit peser 1 méga octet au maximum',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {

            $id = Auth::user()->id;
            $data = User::find($id);

            // $data->username = $request->username;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->city = $request->city;
            $data->zip_code = $request->zip_code;
            $data->updated_at = Carbon::now();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/user_images/' . $data->photo)); #to replace previous photo in folder by new one
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/user_images'), $filename);
                $data->photo = $filename;
            }

            $data->save();

            return response()->json([
                'status' => 200,
                'messages' => 'Profile mis à jour avec succès!'
            ]);
        }
    }








    public function newPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'new_password' => ['required', 'min:6', 'max:30'],
        ], [
            'new_password.required' => 'Ce champ est requis',
            'new_password.min' => 'Le mot de passe doit avoir au moins 6 caractères',
            'new_password.max' => 'Le mot de passe doit avoir 30 caractères maximums'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {

            if (!Hash::check($request->old_password, auth::user()->password)) {

                return response()->json([
                    'status' => 401,
                    'messages' => 'L\'ancien mot de passe n\'est pas valide'
                ]);
            } else {
                User::whereId(auth()->user()->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);

                return response()->json([
                    'status' => 200,
                    'messages' => 'Mot de passe mis à jour avec succès.'
                ]);
            }
        }
    }




    public function userDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/');
    }
}
