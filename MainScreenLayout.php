<?php
// Main Screen Layout
class MainScreenLayout {
    public $header;
    public $footer;
    public $menu;
    
    public function __construct($header, $footer, $menu) {
        $this->header = $header;
        $this->footer = $footer;
        $this->menu = $menu;
    }

    public function displayMainLayout() {
        echo "<header>" . $this->header . "</header>";
        echo "<nav>" . $this->menu . "</nav>";
        echo "<footer>" . $this->footer . "</footer>";
    }
}

// Example usage
$mainScreen = new MainScreenLayout("Welcome to Galactic Empires", "2025 Galactic Empires", "Home | Fleet | Research | Diplomacy");
$mainScreen->displayMainLayout();
?>
