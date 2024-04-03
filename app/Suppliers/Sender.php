<?php

namespace App\Suppliers;

use App\Abstratctions\Suppliers;
use App\Interfaces\Suppliers as Supplier;
use Http;
use Illuminate\Http\Request;

class Sender extends Suppliers implements Supplier
{
    public function fetchData(Request $request): void
    {
        $response = Http::withHeaders($this->headers)->get($this->APILink . '/menu?branch_id=' . $this->branch_id);
        $this->response = $response->collect();
    }

    public function setData(string $clientId = 'clientId', string $clientSecret = 'clientSecret'): void
    {
        $this->APILink = 'http://localhost';
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->headers = [
            'client-id' => $this->clientId,
            'client-secret' => $this->clientSecret,
        ];
    }

    public function order(array $object): mixed
    {
        return Http::withHeaders($this->headers)->post($this->APILink . '/order/store', $object);
    }

    public function updateStatus(object $request, object $order): mixed
    {
        try {
            Http::withHeaders($this->headers)->put($this->APILink . '/order/update', [
                'order_id' => $order->id,
                'order_status' => $request->status,
            ]);
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }
}
