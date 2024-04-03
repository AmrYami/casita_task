<?php

function serverName()
{
    $sslOrNot = env('HTTPS');
    if ($sslOrNot == FALSE)
        $sslOrNot = 'http://';
    else
        $sslOrNot = 'https://';
    return $sslOrNot . request()->getHost();
}

function ResponseHelper($code, $message, $bool = false ,$data = []): mixed
{
    return response()->json([
        'success' => $bool,
        'data' => $data,
        'message' => $message,
    ], $code);
}
