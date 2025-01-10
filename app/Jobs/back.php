<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\AllHotelModel;
use Illuminate\Support\Facades\Log;

class ProcessHotels implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $headerData;

    public function __construct($headerData)
    {
        $this->headerData = $headerData;
    }

    public function handle()
    {
        $url = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels";
        $iterations = 43;  // Number of batches (43 * 1000 hotels)
        $batchSize = 1000; // Number of hotels per batch

        for ($i = 0; $i < $iterations; $i++) {
            // Calculate 'from' and 'to' for each batch
            $from = ($i * $batchSize) + 1;
            $to = ($from + $batchSize) - 1;

            // Construct the request URL
            $queryParams = http_build_query([
                'language' => 'ENG',
                'from' => $from,
                'to' => $to,
                'countryCode' => 'US',
            ]);

            $requestUrl = "{$url}?{$queryParams}";

            // Initialize cURL for API request
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $requestUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $this->headerData
            ]);

            // Execute the cURL request and get the response
            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);

            // Log any error in the cURL request
            if ($error) {
                Log::error("cURL error for batch {$from} - {$to}: " . $error);
                continue; // Skip to the next iteration if the request fails
            }

            // Decode the JSON response
            $data = json_decode($response, true);

            // Check if the 'hotels' key exists in the response
            if (!isset($data['hotels'])) {
                Log::warning("No hotels data found for batch {$from} - {$to}");
                continue; // Skip to the next iteration if no hotels found
            }

            // Process and insert hotel data
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
                $hotel->email = @$val['email'];
                $hotel->city = @$val['city']['content'];
                $hotel->postalCode = @$val['postalCode'];
                $hotel->segments = json_encode(@$val['segmentCodes']);
                $hotel->boards = json_encode(@$val['boardCodes']);
                $hotel->accommodationType = @$val['accommodationTypeCode'];
                $hotel->coordinates = json_encode(@$val['coordinates']);

                // Save each hotel to the database
                $hotel->save();
            }
            echo $from ."-". $to;

            Log::info("Successfully processed and saved hotels for batch {$from} - {$to}");
        }
    }
}
