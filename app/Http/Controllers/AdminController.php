<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\VendorApproveNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{


    public function adminDashboard()
    {
        return view('admin.index');
    }




    public function adminProfile()
    {
        # get the id of the user who's actually login
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile', compact('adminData'));
    }



    public function adminProfileStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'max:100'],
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
            $data->updated_at = Carbon::now();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/admin_images/' . $data->photo)); #to replace previous photo in folder by new one
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
                $data->photo = $filename;
            }

            $data->save();

            return response()->json([
                'status' => 200,
                'messages' => 'Profile mis à jour avec succès!'
            ]);
        }
    }






    public function adminChangeSetting()
    {
        return view('admin.admin_change_setting');
    }








    public function adminPasswordStore(Request $request)
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







    public function adminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }






    /**
     * Inactive vendor
     */
    public function inactiveVendor()
    {
        # get all user that role is vendor and status is inactive
        $inactive_vendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();

        return view('backend.vendor.inactive_vendor', compact('inactive_vendor'));
    }






    public function activeVendor()
    {
        # get all user that role is vendor and status is active
        $active_vendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();

        return view('backend.vendor.active_vendor', compact('active_vendor'));
    }








    public function inactiveVendorDetails($id)
    {
        $inactive_vendor_details = User::findOrFail($id);

        return view('backend.vendor.inactive_vendor_details', compact('inactive_vendor_details'));
    }








    public function activeVendorApprove(Request $request)
    {
        $vendor_id = $request->id;
        User::findOrFail($vendor_id)->update([
            'status' => 'active'
        ]);

        $notification = array(
            'message' => 'Vendeur activé avec avec succès',
            'alert-type' => 'success'
        );

        // Send notification to vendor when account is activated
        $new_vendor = User::where('role', 'vendor')
            ->where('id', $vendor_id)
            ->get();
        Notification::send($new_vendor, new VendorApproveNotification($request));

        return redirect()->route('active.vendor')->with($notification);
    }







    public function activeVendorDetails($id)
    {
        $active_vendor_details = User::findOrFail($id);

        return view('backend.vendor.active_vendor_details', compact('active_vendor_details'));
    }






    public function inactiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'inactive'
        ]);

        $notification = array(
            'message' => 'Vendeur désactivé avec avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.vendor')->with($notification);
    }






    //////////////////////////////////////////////////////////////////////
    //
    // Gestion des administrateurs selon leur role

    public function allAdmin()
    {
        $all_admin = User::where('role', 'admin')->latest()->get();

        return view('backend.admin.all_admin', compact('all_admin'));
    }

    public function addAdmin()
    {

        return view('backend.admin.add_admin');
    }

    public function storeAdmin(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->email_verified_at = Carbon::now(); // verification d'email directement
        $user->save();


        $notification = array(
            'message' => 'Administrateur crée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function editAdmin($id)
    {
        $user = User::findOrFail($id);

        return view('backend.admin.edit_admin', compact('user'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();


        $notification = array(
            'message' => 'Paramètre administrateur mis à jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function deleteAdmin($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'Administrateur supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
