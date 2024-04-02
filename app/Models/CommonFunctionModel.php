<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;

class commonFunctionModel extends Model
{
    use HasFactory;



    public function getFromToCurrencyRate($inputAmount = 1.00, $fromCurrency = 'INR', $toCurrency = 'USD')
    {


        $endpoint = 'convert';
        $access_key = '80ef0342243297ab986d2a486ae03eef';

        $from = $fromCurrency;
        $to = $toCurrency;
        $amount = $inputAmount;

        // initialize CURL:
        $ch = curl_init('https://api.exchangeratesapi.io/v1/' . $endpoint . '?access_key=' . $access_key . '&from=' . $from . '&to=' . $to . '&amount=' . $amount . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $conversionResult = json_decode($json, true);

        return $conversionResult['result'];
    }





    public function displayFinalRates($inputAmount = 0.00, $toCurrencyRate = 0.012)
    {
        $finalTotal = $inputAmount * $toCurrencyRate;
        return number_format($finalTotal, 2, '.', '');
    }



}