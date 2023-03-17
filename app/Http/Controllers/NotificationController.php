<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function App\howDays;

class NotificationController extends Controller
{
    // public function markAsRead($id)
    // {
    //     $date_sent = DB::table('notifications')->pluck('created_at'); // return array

    //     $date = howDays($date_sent);


    //     // on supprime les
    //     if ($date >= 30) {
    //         DB::table('notifications')
    //             ->where('id', $id)
    //             ->delete();
    //     } else {
    //         DB::table('notifications')
    //             ->where('id', $id)
    //             ->update(['read_at' => Carbon::now()]);
    //     }

    //     return redirect()->back();
    // }



    public function markAsRead($id)
    {

        DB::table('notifications')
            ->where('id', $id)
            // ->update(['read_at' => Carbon::now()]);
            ->delete();


        return redirect()->back();
    }
}
