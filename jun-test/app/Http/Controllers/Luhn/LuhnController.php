<?php

namespace App\Http\Controllers\Luhn;

use App\Models\Luhn\Luhn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LuhnController extends Controller
{
    public function index()
    {
        $testNumbers = [
            4141123441414143,
            4141123441414145,
            1234567812354141,
            4141123441415678,
            1234567812351433,
            4141123441414135,
        ];
        $numbers = [];
        foreach ($testNumbers as $testNumber){
            if (Luhn::isValidCreditCard($testNumber))
                $valid = 'yes';
            else
                $valid = 'no';
            $numbers[] = [
                'number' => $testNumber,
                'valid' => $valid
            ];
        }

        return view('luhn.index', compact('numbers'));
    }

    public function check(Request $request)
    {
        $this->validate($request, [
            'number' => 'required|numeric|min:1000000000000000|max:9999999999999999',
        ]);
        $number = $request->number;

        if (Luhn::isValidCreditCard($number)) {
            $response = [
                'isValid' => true
            ];
        }
        else {
            $response = [
                'isValid' => false
            ];
        }
        return $response;
    }
}
