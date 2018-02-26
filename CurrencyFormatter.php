<?php

namespace NepaliCurrencyFormatter;

class CurrencyFormatter
{
    /**
     * Formats money and supports numbers up to 99,99,99,999
     *
     * @param int $number
     * @param array $config
     *
     * @return mixed|string
     */
    public function formatToMoney(int $number, array $config = [])
    {
        if (strlen($number) > 9) {
            return $number;
        }

        $hundreds = $thousands = $lakhs = $crors = $negative = '';

        if (strstr($number, "-")) {
            $number = str_replace("-", "", $number);
            $negative = "-";
        }

        $split_number = @explode("." , $number);

        $rupee = $split_number[0];
        $paise = @$split_number[1];

        if (@strlen($rupee) > 3) {
            $hundreds = substr($rupee, strlen($rupee) - 3);
            $remaining = substr($rupee, 0, strlen($rupee) - 3);

            if (strlen($remaining) < 3) {
                $thousands = $remaining . ',';
            } else {
                $thousands = strrev(substr(strrev($remaining), 0, 2)).',';
                $lakhs = strrev(substr(strrev($remaining), 2, 2)).',';

                if (strlen($remaining) > 4) {
                    $crors = strrev(substr(strrev($remaining), 4, 2)).',';
                }
            }

            $formatted_rupee = $crors . $lakhs . $thousands . $hundreds;
        } else {
            $formatted_rupee = $rupee;
        }

        $formatted_paise = (int) $paise > 0 
            ? "." . substr($paise, 0, 2)
            : "." . substr("00", 0, 2);

        return !empty($config['is_unicode']) && is_bool($config['is_unicode'])
            ? ' ' . $this->getNepali($negative . $formatted_rupee. $formatted_paise)
            : ' ' . $negative . $formatted_rupee . $formatted_paise;
    }

    protected function getNepali(string $text): string
    {
        return str_replace(
            ["1","2","3","4","5","6","7","8","9","0"],
            ["१","२","३","४","५","६","७","८","९","०"],
            $text
        );
    }
}
