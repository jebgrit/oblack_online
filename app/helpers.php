<?php

namespace App;

use Carbon\Carbon;

// function howDays($from_date)
// {

//     foreach ($from_date as $from) {

//         $offset = strtotime(Carbon::now()) - strtotime($from);

//         return floor($offset / 60 / 60 / 24);
//     }
// }


/// genere un code SKU

function SKU_gen($product_name, $category = null, $brand = null, $id = null, $lengt = 3)
{
    $results = ''; // empty string

    $str1 = explode(' ', $product_name);
    $str1 = array_shift($str1);
    $str1 = strtoupper(substr($str1, 0, $lengt));

    $str2 = explode(' ', $category);
    $str2 = array_shift($str2);
    $str2 = strtoupper(substr($str2, 0, $lengt));

    $str3 = explode(' ', $brand);
    $str3 = array_shift($str3);
    $str3 = strtoupper(substr($str3, 0, $lengt));

    $id = str_pad($id, 4, 0, STR_PAD_LEFT);

    $results .= "{$str1}-{$str2}{$str3}{$id}";


    return $results;
}


/// genere identifiant ticket
function Ticket_ID_gen($name_sender, $id, $date, $lengt = 2)
{
    $ticket_id = ''; // empty string

    $name_sender = explode(' ', $name_sender);
    $name_sender = array_shift($name_sender);
    $name_sender = strtoupper(substr($name_sender, 0, $lengt));


    $ticket_id .= "TK-{$name_sender}{$id}{$date}";


    return $ticket_id;
}


/// genere numéro de commande
/// genere identifiant ticket
// function INVOICE_NO_gen($product_id, $product_qty, $date, $lengt = 2)
// {
//     $ticket_id = ''; // empty string

//     $ticket_id .= "{$product_id}{$id}{$date}";


//     return $ticket_id;
// }
