<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    public static function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;
        $data = [];
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data['products'][] = [
                    'name' => trim($row[0]) ?? '',
                    'article' => trim($row[1]) ?? '',
                    'cost' => trim($row[2]) ?? '',
                    'price' => trim($row[3]) ?? '',
                ];
            }
            fclose($handle);
        }
        return $data;
    }
}
