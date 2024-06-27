<?php

use Money\Money;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Currencies\ISOCurrencies;

// Check if the function 'format_money' does not already exist
if (!function_exists('format_money')) {

    /**
     * Format the given amount as a currency string.
     *
     * @param int $amount The amount of money in minor units (e.g., cents).
     * @param string $currency The currency code (default is 'EUR').
     * @return string The formatted money string.
     */
    function format_money($amount, $currency = 'EUR'): string
    {
        // Create a new Money instance with the given amount and currency
        $money = new Money($amount, new Currency($currency));

        // Create an ISOCurrencies instance which provides currency definitions
        $currencies = new ISOCurrencies();

        // Create a NumberFormatter instance for formatting currency
        $numberFormatter = new \NumberFormatter('de_DE', \NumberFormatter::CURRENCY);

        // Create an IntlMoneyFormatter instance using the NumberFormatter and ISOCurrencies
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        // Format the Money instance and return the formatted string
        return $moneyFormatter->format($money);
    }
}
