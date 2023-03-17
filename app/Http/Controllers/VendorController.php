<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\VendorRegisterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;


class VendorController extends Controller
{

    //////////////////////////////////////////////////////////////
    // 
    // VENDOR REGISTER
    //
    //////////////////////////////////////////////////////////////


    public function becomeVendor()
    {
        return view('auth.become_vendor');
    }


    public function vendorRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:50'],
            'username' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            'phone' => ['required', 'numeric'],
            'password' => ['required', 'min:6', 'max:30'],
        ], [
            'name.required' => 'Ce champ est requis',
            'name.max' => 'Le nom de l\'enseigne doit avoir 100 caractères maximums',
            'username.required' => 'Ce champ est requis',
            'username.max' => 'Le nom doit avoir 100 caractères maximums',
            'email.required' => 'Ce champ est requis',
            'email.email' => 'Le format de l\'email est invalide',
            'email.unique' => 'Cet email existe déjà',
            'email.max' => 'L\'email doit avoir 100 caractères maximums',
            'phone.required' => 'Ce champ est requis',
            'phone.numeric' => 'Vous devez saisir uniquement des chiffres sans espaces',
            'password.required' => 'Ce champ est requis',
            'password.min' => 'Le mot de passe doit avoir au moins 6 caractères',
            'password.max' => 'Le mot de passe doit avoir 30 caractères maximums',
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $user = new User();

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->vendor_join = Carbon::now()->format('d-m-Y');
            $user->password = Hash::make($request->password);
            $user->role = 'vendor';
            $user->status = 'inactive';
            $user->created_at = Carbon::now();

            $save = $user->save();

            if ($save) {
                $notification = array(
                    'message' => 'Inscription réussie!',
                    'alert-type' => 'info'
                );

                // envoyer une notif à l'admin quand un nouveau vendeur s'inscrit
                $vuser = User::where('role', 'admin')->get();
                Notification::send($vuser, new VendorRegisterNotification($request));

                return redirect()->route('login')->with($notification);
            } else {

                $notification = array(
                    'message' => 'Échec de l\'enregistrement. Merci de réesayer plus tard.',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        }
    }





    //////////////////////////////////////////////////////////////
    // 
    // MANAGE VENDOR PROFILE
    //
    //////////////////////////////////////////////////////////////



    public function vendorDashboard()
    {
        return view('vendor.index');
    }


    # Change profil info
    public function vendorProfile()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.vendor_profile', compact('vendorData'));
    }


    public function vendorProfileStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'max:100'],
            'info' => ['nullable', 'max:200'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        ], [
            'name.required' => 'Ce champ est requis',
            'name.max' => 'Le nom de l\'enseigne doit avoir 100 caractères maximums',

            'username.required' => 'Ce champ est requis',
            'username.max' => 'Le nom doit avoir 100 caractères maximums',

            'email.required' => 'Ce champ est requis',
            'email.email' => 'Le format de l\'email est invalide',
            'email.max' => 'L\'email doit avoir 100 caractères maximums',

            'phone.required' => 'Ce champ est requis',
            'phone.numeric' => 'Vous devez saisir uniquement des chiffres sans espaces',

            'address.required' => 'Ce champ est requis',
            'address.max' => 'Le mot de passe doit avoir 30 caractères maximums',

            'info.max' => 'Votre bio doit avoir 200 caractère maximums',

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

            $data->username = $request->username;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->vendor_short_info = $request->info;
            $data->updated_at = Carbon::now();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/vendor_images/' . $data->photo)); #to replace previous photo in folder by new one
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/vendor_images'), $filename);
                $data->photo = $filename;
            }

            $data->save();

            return response()->json([
                'status' => 200,
                'messages' => 'Profile mis à jour avec succès!'
            ]);
        }
    }






    # Change password
    public function vendorChangeSetting()
    {
        return view('vendor.vendor_change_setting');
    }





    public function vendorPasswordStore(Request $request)
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







    # logout
    public function vendorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
