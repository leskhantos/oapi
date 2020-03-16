<?php

namespace App\Http\Controllers;

use App\Entities\Spot;
use App\Entities\Voucher;
use Illuminate\Http\Request;

class VouchersController extends Controller
{
    public function generateVouchers($id)
    {
        $voucher = Voucher::max('list_id');
        $list_id = $voucher + 1;
        $number = 8;
        $arr = array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'k', 'm', 'n', 'p', 'r', 's', 't',
            'v', 'x', 'y', 'z', '2', '3', '4', '5', '6', '7', '8', '9');
        // Генерируем коды
        for ($i = 0; $i < 52; $i++) {
            $code = "";
            for ($j = 0; $j < $number; $j++) {
                // Вычисляем случайный индекс массива
                $index = rand(0, count($arr) - 1);
                $code .= $arr[$index];
            }
            Voucher::create(['code' => $code, 'spot_id' => $id, 'list_id' => $list_id]);
        }
        return Voucher::select('id', 'code')->where('list_id', $list_id)->get();
    }
}
