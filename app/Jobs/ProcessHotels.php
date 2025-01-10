<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\AllHotelModel;

class ProcessHotels implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $from;
    public $to;
    public $headerData;

    public function __construct($from, $to,$headerData)
    {
        $this->from = $from;
        $this->to = $to;
         $this->headerData = $headerData;
    }

    public function handle()
    {
        // dd(186);
        // $apiUrl = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?language=ENG&from={$this->from}&to={$this->to}";

        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, $apiUrl);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl,  CURLOPT_HTTPHEADER ,$this->headerData);
        // $response = curl_exec($curl);
        // curl_close($curl);
         $url = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels";

            $queryParams = http_build_query([
                'language' => 'ENG',
                'from' => $this->from,
                'to' => $this->to,
                'countryCode' => 'US',
                // 'fields' => 'code',
            ]);

            $requestUrl = "{$url}?{$queryParams}";

            // Initialize cURL
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $requestUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER =>$this->headerData
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);

        $data = json_decode($response, true);
        // dd($data);

        if (!isset($data['hotels'])) {
            return;
        }

        foreach ($data['hotels'] as $val) {
            $hotel = new AllHotelModel();


            $hotel->code = @$val['code'];
            $hotel->region = 'US';
            $hotel->name = @$val['name']['content'];
            $hotel->description = @$val['description']['content'];
            $hotel->country = @$val['countryCode'];
            $hotel->state = @$val['stateCode'];
            $hotel->destination = @$val['destinationCode'];
            $hotel->zone = @$val['zoneCode'];
            $hotel->address1 = @$val['address']['content'];
            $hotel->address2 = @$val['address']['content'];

            $hotel->images =  json_encode(@$val['images']);
            $hotel->facilities =  json_encode(@$val['facilities']);
            $hotel->interestPoints =  json_encode(@$val['interestPoints']);
            $hotel->rooms =  json_encode(@$val['rooms']);
            $hotel->phones = json_encode(@$val['phones']);

            $hotel->email =@$val['email'];
            $hotel->city = @$val['city']['content'];
            $hotel->postalCode = @$val['postalCode'];
            $hotel->segments = json_encode(@$val['segmentCodes']);
            $hotel->boards = json_encode(@$val['boardCodes']);
            $hotel->accommodationType = @$val['accommodationTypeCode'];
            $hotel->coordinates = json_encode(@$val['coordinates']);
            $hotel->save();
        }
    }
}
