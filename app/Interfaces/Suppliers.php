<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface Suppliers
{
    public function fetchData(Request $request): void;

    public function order(array $object): mixed;

    public function updateStatus(object $request, object $order): mixed;
}
