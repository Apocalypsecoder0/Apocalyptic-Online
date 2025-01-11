<?php
// Resource Production Scaling System
class ResourceProductionScaling {
    public $resourceType;
    public $scalingFactor;
    
    public function __construct($resourceType, $scalingFactor) {
        $this->resourceType = $resourceType;
        $this->scalingFactor = $scalingFactor;
    }

    public function displayScalingDetails() {
        echo "<h3>Resource Production Scaling:</h3>";
        echo "<p>Resource Type: " . $this->resourceType . "</p>";
        echo "<p>Scaling Factor: " . $this->scalingFactor . "</p>";
    }
}

// Example usage
$scaling = new ResourceProductionScaling("Minerals", "2x per level");
$scaling->displayScalingDetails();
?>
