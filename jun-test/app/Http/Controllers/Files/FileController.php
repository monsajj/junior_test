<?php

namespace App\Http\Controllers\Files;

use App\Models\Files\Files;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index() {
        return view('files.index');
    }

    public function store(Request $request) {
        //validate file
        $data = $request->all();
        $vfields['import'] = 'required|mimes:csv,txt';
        Validator::make($data, $vfields)->validate();
        //get and validate array from file
        $items = Files::csvToArray($data['import']);
        Validator::make($items, [
            'products' => 'required|array',
            'products.*.name' => 'required|string|max:190',
            'products.*.article' => 'required|string|max:190',
            'products.*.cost' => 'required|numeric|min:0.000001',
            'products.*.price' => 'required|numeric|min:0.000001',
        ])->validate();
        //get products list
        $products = [];
        $id = 1;
        foreach ($items['products'] as $item) {
            $extra = (($item['price'] / $item['cost']) * 100 - 100);
            switch (true) {
                case ($extra > 16):
                    $color = 'red';
                    break;
                case ($extra <= 16 && $extra >= 10):
                    $color = 'orange';
                    break;
                case ($extra < 10):
                    $color = 'lightgreen';
                    break;
                default:
                    $color = 'white';
                    break;
            }
            $products[] = [
                'id' => $id,
                'name' => $item['name'],
                'article' => $item['article'],
                'cost' => $item['cost'],
                'price' => $item['price'],
                'extra-charge' => $extra . '%',
                'color' => $color
            ];
            $id++;
        }
        return view('files.index', compact('products'));
    }
}
