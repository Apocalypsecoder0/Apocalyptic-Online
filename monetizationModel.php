<?php
// Monetization Model Class
class MonetizationModel {
    public $premiumCurrency;
    public $microtransactions;
    
    public function __construct($premiumCurrency, $microtransactions) {
        $this->premiumCurrency = $premiumCurrency;
        $this->microtransactions = $microtransactions;
    }

    public function displayMonetization() {
        echo "<h3>Monetization Model:</h3>";
        echo "<p>Premium Currency: " . $this->premiumCurrency . "</p>";
        echo "<p>Microtransactions: " . $this->microtransactions . "</p>";
    }
}

// Example usage
$monetization = new MonetizationModel("Galactic Credits", "Skins, Boosters, Premium Membership");
$monetization->displayMonetization();
?>
