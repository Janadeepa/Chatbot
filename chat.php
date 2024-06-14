<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = strtolower($_POST['message']); // Convert message to lowercase
    $response = "";

    // Load intents and responses from JSON file
    $intentsFile = 'intents.json';
    $intents = json_decode(file_get_contents($intentsFile), true);

    // Find matching intent
    foreach ($intents['intents'] as $intent) {
        foreach ($intent['patterns'] as $pattern) {
            if (strpos($message, $pattern) !== false) {
                $response = $intent['responses'][array_rand($intent['responses'])];
                break 2; // Exit both loops
            }
        }
    }

    // If no matching intent found, provide default response
    if (empty($response)) {
        $response = "I'm sorry, I didn't understand that.";
    }

    echo $response;
}
?>
