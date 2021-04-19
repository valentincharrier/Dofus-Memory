<?php


namespace App\Service;


class EncoderService
{
    /**
     * ▬▬▬▬ Create un Token ▬▬▬▬
     * @param String $value
     * @return String
     */
    public function encoderBB(String $value):String {
        $encodeBoard = [sha1(md5(crypt($value, 'Salage'))), md5(crypt(sha1($value), 'Salage')), crypt(sha1(md5($value)), 'Salage')];

       return $encodeBoard[rand(0,2)];
    }
}