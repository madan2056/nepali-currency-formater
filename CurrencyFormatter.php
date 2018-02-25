<?php
class CurrencyFormatter {

  public function formatToMoney($number, $is_unicode = false)
    {
        // supports upto 99,99,99,999
        if (strlen($number) > 9)
            return $number;
        
        $hundreds = $thousands = $lakhs = $crors = $negative = '';
        if(strstr($number,"-"))
        {
            $number = str_replace("-","",$number);
            $negative = "-";
        }

        $split_number = @explode(".",$number);

        $rupee = $split_number[0];
        $paise = @$split_number[1];

        if(@strlen($rupee)>3)
        {
            $hundreds = substr($rupee,strlen($rupee)-3);
            $remaining = substr($rupee,0,strlen($rupee)-3);

            if (strlen($remaining) < 3) {
                $thousands = $remaining.',';
            } else {

                $thousands = strrev(substr(strrev($remaining), 0, 2)).',';
                $lakhs = strrev(substr(strrev($remaining), 2, 2)).',';

                if (strlen($remaining) > 4) {

                    $crors = strrev(substr(strrev($remaining), 4, 2)).',';

                }

            }

            $formatted_rupee = $crors.$lakhs.$thousands.$hundreds;
        }
        else
        {
            $formatted_rupee = $rupee;
        }

        if((int)$paise>0)
        {
            $formatted_paise = ".".substr($paise,0,2);
        }
        else
        {
            $formatted_paise = ".".substr("00",0,2);
        }

        if($is_unicode){
            return ' '.$this->get_nep($negative.$formatted_rupee.$formatted_paise);
        }
        else{
            return ' '.$negative.$formatted_rupee.$formatted_paise;
        }
    }

    protected function get_nep($eng_str){
        $replace 	= array("१","२","३","४","५","६","७","८","९","०" );
        $find 	 	= array("1","2","3","4","5","6","7","8","9","0" );
        $nep_str	=  str_replace($find, $replace, $eng_str);
        return $nep_str;
    }

}
