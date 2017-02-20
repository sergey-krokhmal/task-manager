<?php
namespace Krokhmal\Soft\Helpers;

class UUID
{
    public static function generateV4()
    {
        // 32 байта младшей части время
        // старшие 16 бит
        $low_time_h = mt_rand(0, 0xffff);
        // младшие 16 бит
        $low_time_l = mt_rand(0, 0xffff);
        
        // 16 байта средней части время
        $mid_time = mt_rand(0, 0xffff);
        
        // 16 бит старшей части - время в 12 младших битах и версия кодировки (4) в старших 4-х  битах
        $time_hi_and_version = mt_rand(0, 0x0fff) | 0x4000;

		// 16 бит - тактовая последовательность, из них старшие 2 бита зарезервированы со значением 10
		$clk_seq_res = mt_rand(0, 0x3fff) | 0x8000;
        
		// 48 бит, завершающих код
        $addit_hi = mt_rand(0, 0xffff);
		$addit_mid = mt_rand(0, 0xffff);
        $addit_low = mt_rand(0, 0xffff);
        
        $uuid4_string = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            $low_time_h, $low_time_l,
            $mid_time,
            $time_hi_and_version,
            $clk_seq_res,
            $addit_hi, $addit_mid, $addit_low);
        return $uuid4_string;
    }
}