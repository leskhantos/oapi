<?php

namespace App\Http\Controllers;

use App\Entities\Spot;
use App\Entities\Voucher;
use Illuminate\Http\Request;

class VouchersController extends Controller
{
    public function generateVouchers($id)
    {
        $data = new \DateTime();
        Spot::findOrFail($id);
        $voucher = Voucher::max('list_id');
//        dd(Voucher::count());
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
            Voucher::create(['code' => $code, 'created' => $data, 'spot_id' => $id, 'list_id' => $list_id]);
        }
        $vouchers = Voucher::select('id', 'code')->whereList_id($list_id)->get();

        return $vouchers;
    }

    public function getLastGenerate()
    {
        $voucher = Voucher::max('list_id');
        return Voucher::whereList_id($voucher)->get();
    }

    public function showList($id)
    {
        Spot::findOrFail($id);
        $list = Voucher::select('list_id', 'created', 'dt_start', 'dt_end', 'can_used')
            ->whereSpot_id($id)->distinct()->get();

        return $list;
    }

    public function getVouchersBySpot($id, Request $request)
    {
        $data = new \DateTime();
        $activity = $request->activity;
        Spot::findOrFail($id);
        $vouchers = Voucher::select('id', 'room', 'dt_start', 'dt_end', 'can_used')->whereSpot_id($id);
        switch ($activity) {
            case 1://Active
                $vouchers = $vouchers->where('dt_end', '>', $data);
                break;
            case 2://Passive
                $vouchers = $vouchers->where('dt_end', '<', $data);
                break;
        }
        $vouchers = $vouchers->get();
        return $vouchers;
    }

    public function getVouchersByList($id)
    {
        $maxList = Voucher::max('list_id');
        if ($id > $maxList) {
            return response('F', 404);
        }
        $vouchers = Voucher::whereList_id($id)->get();
        return $vouchers;
    }

    public function update($id, Request $request)
    {
        Voucher::findOrFail($id);
        $voucher = Voucher::whereId($id)->where('dt_end', '!=', null)->get()->toArray();
//        dd($voucher);
        if (empty($voucher)) {
            Voucher::whereId($id)->update($request->all());
            return 12;
        } else {
            return 'Активирован ранее';
        }
    }
}
