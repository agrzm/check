<?php

function generateUsername($length, $usernameType) {
    $characters = '';
    if ($usernameType === 'letters') {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
    } elseif ($usernameType === 'numbers') {
        $characters = '0123456789';
    } elseif ($usernameType === 'both') {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    }
    
    $username = '';
    for ($i = 0; $i < $length; $i++) {
        $username .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $username;
}

function checkInstagramUsername($username) {
    $url = "https://www.instagram.com/$username/";
    $headers = @get_headers($url);
    if ($headers && strpos($headers[0], '200')) {
        return false; // Kullanıcı adı dolu
    } else {
        return true; // Kullanıcı adı boşta
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $length = (int)$_POST['length'];
    $usernameType = $_POST['usernameType'];

    $availableUsernames = [];
    $takenUsernames = [];

    for ($i = 0; $i < 50; $i++) {
        $username = generateUsername($length, $usernameType);
        if (checkInstagramUsername($username)) {
            $availableUsernames[] = $username;
        } else {
            $takenUsernames[] = $username;
        }
    }

    echo json_encode([
        'available' => $availableUsernames,
        'taken' => $takenUsernames,
    ]);
}
