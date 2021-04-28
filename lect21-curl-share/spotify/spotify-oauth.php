<?php
    require("spotify-creds.php");

    // Checks for $_GET['code']
    if(!isset($_GET['code']) || empty($_GET['code'])) {
        echo "No code provided. Your redirect uri is printed below.";
        echo "<hr />";
        echo 'http://'. $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
        exit(0);
    }

    // https://developer.spotify.com/documentation/general/guides/authorization-guide
    // POST request to https://accounts.spotify.com/api/token
    
    // 1. Create $data

    // 2. Determine URL

    // 3. Make Request

    // 4. Parse Response

    // 5. Filter Response (only get what you need)