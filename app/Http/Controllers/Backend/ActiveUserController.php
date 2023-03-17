<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveUserController extends Controller
{
    /**
     * All user
     */
    public function allUser()
    {
        $users = User::where('role', 'user')->latest()->get();

        return view('backend.user.all_user', compact('users'));
    }

    /**
     * All vendor
     */
    public function allVendor()
    {
        $vendors = User::where('role', 'vendor')->latest()->get();

        return view('backend.user.all_vendor', compact('vendors'));
    }


    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Compte utilisateur supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    public function deleteVendor($id)
    {

        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Compte vendeur supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
