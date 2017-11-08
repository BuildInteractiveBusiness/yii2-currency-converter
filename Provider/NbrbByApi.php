<?php

namespace imanilchaudhari\CurrencyConverter\Provider;

/**
 * It's API for nbrb.by site
 */
class NbrbByApi implements ProviderInterface
{
    /**
     * Url where Curl request is made
     *
     * @var strig
     */
    const API_URL = 'http://www.nbrb.by/API/ExRates/Rates/[fromCurrency]?ParamMode=2';

    /**
     * {@inheritDoc}
     */
    public function getRate($fromCurrency, $toCurrency)
    {
        $fromCurrency = urlencode($fromCurrency);
        $toCurrency = urlencode($toCurrency);

        $url = str_replace(
            '[fromCurrency]',
            $fromCurrency,
            static::API_URL
        );

        $ch = curl_init();
        $timeout = 0;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $rawdata = curl_exec($ch);
        curl_close($ch);

		print_r(explode(',', $rawdata)[1]);die();
        // return explode(',', $rawdata)[1];
    }
}
