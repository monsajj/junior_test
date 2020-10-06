<?php

namespace App\Models\Luhn;

use Illuminate\Database\Eloquent\Model;

class Luhn extends Model
{
    public static function isValidCreditCard($s) {
        $s = strrev(preg_replace('/[^\d]/','',$s));
        if (strlen($s) != 16) {
            return false;
        }
        $sum = 0;
        for ($i = 0, $j = strlen($s); $i < $j; $i++) {
            if (($i % 2) == 0) {
                $val = $s[$i];
            } else {
                $val = $s[$i] * 2;
                if ($val > 9)  $val -= 9;
            }
            $sum += $val;
        }
        return (($sum % 10) == 0);
    }
}
