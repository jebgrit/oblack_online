<?php

namespace App\Http\Controllers\Fronted;

use App\Exports\ContactExport;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Notifications\ContactNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    //
    public function contact()
    {
        return view('fronted.contact');
    }



    public function contactStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:100'],
            'subject' => ['required', 'max:100'],
            'phone' => ['required', 'numeric'],
            'message' => ['required'],
        ], [
            'name.required' => 'Ce champ est requis',
            'name.max' => 'Le nom doit avoir 100 caractères maximums',
            'email.required' => 'Ce champ est requis',
            'email.email' => 'Le format de l\'email est invalide',
            'email.max' => 'L\'email doit avoir 100 caractères maximums',
            'phone.required' => 'Ce champ est requis',
            'phone.numeric' => 'Vous devez saisir uniquement des chiffres sans espaces',
            'subject.required' => 'Ce champ est requis',
            'subject.max' => 'Le sujet doit avoir 100 caractères maximums',
            'message.required' => 'Ce champ est requis',
        ]);


        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {

            Contact::insert([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'phone' => $request->phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);

            // envoyer une notif à l'admin
            $user = User::where('role', 'admin')->get();
            Notification::send($user, new ContactNotification($request));

            return response()->json([
                'status' => 200,
                'messages' => 'Votre message a été envoyé!'
            ]);
        }
    }









    public function contactMessage()
    {
        $contacts = Contact::latest()->get();

        return view('backend.contact.all_contact', compact('contacts'));
    }








    public function showMessage($id)
    {
        $contact = Contact::where('id', $id)->firstOrFail();

        return view('backend.contact.show_contact', compact('contact'));
    }








    public function deleteMessage($id)
    {
        Contact::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Message supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }







    // export ticket
    public function exportMessage()
    {
        return Excel::download(new ContactExport, 'contact_form.xlsx');
    }
}
