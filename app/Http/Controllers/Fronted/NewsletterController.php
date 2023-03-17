<?php

namespace App\Http\Controllers\Fronted;

use App\Exports\NewsletterExport;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\User;
use App\Notifications\NewsLetterNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class NewsletterController extends Controller
{
    public function newsletterStore(Request $request)
    {
        Newsletter::insert([
            'email' => $request->email,
            'created_at' => Carbon::now(),
        ]);


        // envoyer une notif à l'admin
        // $user = Role::where('name', 'Super admin')->get(); cherche à envoyer la notif à l'admin selon son grade, petit soucis avec spatie à ce niveau
        $user = User::where('role', 'admin')->get();
        Notification::send($user, new NewsLetterNotification($request));

        $notification = array(
            'message' => 'Merci pour votre inscription!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function newsletter()
    {
        $newsletter = Newsletter::latest()->get();

        return view('backend.newsletter.all_newsletter', compact('newsletter'));
    }


    public function deleteNewsletter($id)
    {
        Newsletter::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // export ticket
    public function exportNewsletter()
    {
        return Excel::download(new NewsletterExport, 'newsletter.xlsx');
    }
}
