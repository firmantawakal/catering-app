<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class String_ {

    function split_date($range_date){			
		$string = explode(' - ',$range_date);

		$date11 = explode('/',$string[0]);
		$date22 = explode('/',$string[1]);

		$data['date1'] = $date11[2].'-'.$date11[1].'-'.$date11[0];
		$data['date2'] = $date22[2].'-'.$date22[1].'-'.$date22[0];

        return $data;
    }

    function base62($num) {
        $index = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $res = '';
        do {
            $res = $index[$num % 62] . $res;
            $num = intval($num / 62);
        } while ($num);
        return $res;
    }

    function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function rupiah($angka){
	
        $hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    function dbdate_to_indo($date) {
        $phpdate = strtotime( $date );
        $dt = date( 'd/m/Y', $phpdate );
        return $dt;
    }

    function date_to_db($date) {
        $phpdate = strtotime(str_replace('/', '-', $date));
        $dt = date( 'Y-m-d', $phpdate );
        return $dt;
    }

    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
     
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }

    function bln_indo ($x) {
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $x);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
     
        return $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
}