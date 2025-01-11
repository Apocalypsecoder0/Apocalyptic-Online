<?php
// Real-Time Communication System
class RealTimeCommunication {
    public $communicationType;
    public $platformsSupported;
    
    public function __construct($communicationType, $platformsSupported) {
        $this->communicationType = $communicationType;
        $this->platformsSupported = $platformsSupported;
    }

    public function displayCommunicationDetails() {
        echo "<h3>Real-Time Communication:</h3>";
        echo "<p>Communication Type: " . $this->communicationType . "</p>";
        echo "<p>Platforms Supported: " . implode(", ", $this->platformsSupported) . "</p>";
    }
}

// Example usage
$rtc = new RealTimeCommunication("Text, Voice, Video", ["PS5", "Xbox Series X", "PC"]);
$rtc->displayCommunicationDetails();
?>
