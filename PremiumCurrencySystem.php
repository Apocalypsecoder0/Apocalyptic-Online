<?php
// Premium Currency System
class PremiumCurrency {
    public $currencyName;
    public $exchangeRate;
    
    public function __construct($currencyName, $exchangeRate) {
        $this->currencyName = $currencyName;
        $this->exchangeRate = $exchangeRate;
    }

    public function displayCurrencyDetails() {
        echo "<h3>Premium Currency:</h3>";
        echo "<p>Name: " . $this->currencyName . "</p>";
        echo "<p>Exchange Rate: " . $this->exchangeRate . "</p>";
    }
}

// Example usage
$premiumCurrency = new PremiumCurrency("Galactic Credits", "1 USD = 1000 Galactic Credits");
$premiumCurrency->displayCurrencyDetails();
?>
