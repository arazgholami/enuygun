<?php

namespace App\Support\Currency;

class CurrencyGateway
{
    private $namespace = null;

    /**
     * CurrencyGateway constructor.
     * @param $provider
     */
    public function __construct($provider)
    {
        $namespace = 'App\\Support\\Currency\\Adapters\\' . $provider;

        if (class_exists($namespace)) {
            $this->namespace = $namespace;
        }
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return new $this->namespace;
    }
}
