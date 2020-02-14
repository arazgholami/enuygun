<?php

namespace App\Support\Currency;

class CurrencyBase
{
    /**
     * @param bool $status
     * @param string $message
     * @param null $data
     * @return array
     */
    protected function currencyResponse($status = false, $message = '', $data = null)
    {
        return [
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ];
    }
}
