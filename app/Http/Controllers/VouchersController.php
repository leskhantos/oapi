<?php

namespace App\Http\Controllers;

use App\Entities\Spot;
use App\Entities\Voucher;
use App\Http\Requests\Api\Voucher\VoucherUpdate;
use Illuminate\Http\Request;

class VouchersController extends Controller
{
    public function generateVouchers($id)
    {
        $data = new \DateTime();
        Spot::findOrFail($id);
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
            Voucher::create(['code' => $code, 'spot_id' => $id, 'list_id' => $list_id, 'can_used' => 6]);
        }
        $vouchers = Voucher::select('id', 'code')->whereList_id($list_id)->get();

        return $vouchers;
    }

    //Думаю что не нужно

    function sort($array)
    {
        $uniq_list = [];
        $uniq_arr = [];

        foreach ($array as $arr) {
            if (!in_array($arr['list_id'], $uniq_list)) {
                $uniq_list[] = $arr['list_id'];
                $uniq_arr[] = $arr;
            }
        }
        return $uniq_arr;
    }

    public function showList($id)
    {
        $data = new \DateTime();
        Spot::findOrFail($id);

        $array_list = Voucher::select('list_id', 'created')->whereSpot_id($id)->distinct()->get()->toArray();
        $array = $this->sort($array_list);

        $result = [];
        foreach ($array as $arr) {
            $active = $this->getVoucher($id)->where('dt_end', '!=', null)->where('list_id', '=', $arr['list_id'])->count();
            $inactive = $this->getVoucher($id)->where('room', '=', null)->where('list_id', '=', $arr['list_id'])->count();
            $used = $this->getVoucher($id)->where('dt_end', '<', $data)->where('list_id', '=', $arr['list_id'])->count();
//            $used = GuestVoucher::where('')->count();
            // использованный в гуест ваучерс появится

            $result[] = ['list_id' => $arr['list_id'], 'created' => $arr['created_at'], 'used' => $used, 'inactive' => $inactive, 'active' => $active];
        }

        return $result;
    }

    public function getVoucher($id)
    {
        return Voucher::select('id', 'dt_start', 'dt_end')->whereSpot_id($id);
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

    public function update($spot_id, VoucherUpdate $request)
    {
        $date = new \DateTime();
        $expiration = new \DateTime();
        $expiration->modify('+6 month');
        $id = $request->id;
        $f = Voucher::where('spot_id', '=', $spot_id)->find($id);
        if (!$f) {
            return response('Некоректный id', 402);
        }
        $voucher = Voucher::whereId($id)->where('room', '!=', null)->first();

        if (empty($voucher)) {
            Voucher::whereId($id)->update(array_merge($request->validated(),['dt_start'=>$date,'dt_end'=>$expiration]));
            $id = Voucher::whereId($id)->get();
            return response($id, 200);
        } else {
            return response('Активирован ранее', 402);
        }
    }
}
