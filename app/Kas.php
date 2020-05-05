<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    public static function kodeFaktur()
    {
        $cek = Kas::where('faktur', 'LIKE', 'KAS%')->get();
        if ($cek->count() > 0) {
            $return = Kas::where('faktur', 'LIKE', 'KAS%')->orderBy('id', 'DESC')->first();
            $nourut = (int) substr($return->faktur, -8, 8);
            $nourut++;
            $char = "KAS";
            $number = $char  .  sprintf("%08s", $nourut);
        } else {
            $number = "KAS"  . "00000001";
        }
        return $number;
    }
}
