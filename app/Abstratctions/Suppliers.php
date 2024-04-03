<?php

namespace App\Abstratctions;

abstract class Suppliers
{
    protected string $APILink;
    protected string $clientId;
    protected string $clientSecret;

    protected object $response;

    protected array $headers;

    abstract public function setData(
        string $clientId,
        string $clientSecret,
    ): void;
}
