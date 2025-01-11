// Example JavaScript for interactive elements

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize event listeners or elements after the page loads

    // Toggle sidebar visibility
    const sidebarToggleButton = document.getElementById('toggle-sidebar');
    const sidebar = document.querySelector('.sidebar');

    sidebarToggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('hidden');
    });

    // Example of handling button click
    const gameStartButton = document.getElementById('start-game');
    gameStartButton.addEventListener('click', function() {
        startGame();
    });
});

// Function to start the game (placeholder logic)
function startGame() {
    alert("Game starting...");
    // Add logic to start the game or transition to the next screen
}

// Function to handle the loading of new content dynamically
function loadGameContent(contentType) {
    const contentArea = document.querySelector('.game-area');
    contentArea.innerHTML = `<p>Loading ${contentType}...</p>`;
    
    // Simulate loading data from server
    setTimeout(function() {
        contentArea.innerHTML = `<h2>${contentType} Loaded</h2><p>New content for ${contentType} has been loaded successfully!</p>`;
    }, 2000);
}

// Example of fetching data with AJAX (Assuming a PHP server is available)
function fetchPlayerData(playerId) {
    fetch(`player_data.php?id=${playerId}`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            displayPlayerData(data);
        })
        .catch(error => {
            console.error('Error fetching player data:', error);
        });
}

function displayPlayerData(data) {
    const playerInfo = document.getElementById('player-info');
    playerInfo.innerHTML = `<h3>Player Info:</h3><p>Username: ${data.username}</p><p>Level: ${data.level}</p><p>Currency: ${data.currency}</p>`;
}
