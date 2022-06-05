<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class ShippingService
{
    public function getProvince()
    {
        $response = Http::withHeaders([
            'key' => getenv('RAJAONGKIR_KEY')
        ])->get('https://api.rajaongkir.com/starter/province');

        return json_decode($response->body())->rajaongkir->results;
        
    }

    public function detailProvince($id)
    {
        $detailProvince = Http::withHeaders([
            'key' => getenv('RAJAONGKIR_KEY')
        ])->get('https://api.rajaongkir.com/starter/province', [
            'id' => $id
        ]);

        return json_decode($detailProvince->body())->rajaongkir->results;
    }

    public function getListCity($province)
    {
        $listCity = Http::withHeaders([
            'key' => getenv('RAJAONGKIR_KEY')
        ])->get('https://api.rajaongkir.com/starter/city',[
            'province' => $province
        ]);

        return json_decode($listCity->body())->rajaongkir->results;
    }

    public function detailCity($id)
    {
        $detailCity = Http::withHeaders([
            'key' => getenv('RAJAONGKIR_KEY')
        ])->get('https://api.rajaongkir.com/starter/city', [
            'id' => $id
        ]);

        return json_decode($detailCity->body())->rajaongkir->results;
    }
    
    public function listCost($oriCity, $destiCity, $weight, $courier) 
    {
        $cost = Http::withHeaders([
            'key' => getenv('RAJAONGKIR_KEY')
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $oriCity,
            'destination' => $destiCity,
            'weight' => $weight,
            'courier' => $courier
        ]);

        return json_decode($cost->body())->rajaongkir->results[0]->costs;
    }
}