<?php
    // compile.php

    // Get the POST data from the frontend
    $data = json_decode(file_get_contents('php://input'), true);
    $code = $data['code'];

    // Validate that we have code
    if (empty($code)) {
        echo json_encode(array('output' => 'No code provided.'));
        exit;
    }

    // Set up the API key and the correct API URL for OnlineCompiler
    $apiKey = '5c5bd4f165d713b1679ffa0d858f41f4'; // Replace with your actual API key
    $url = 'https://onlinecompiler.io/api/v2/run-code/';

    // Prepare the data for the API request
    $postData = array(
        'api_key' => $apiKey,
        'language' => 'c',  // Set to 'c' for C programs
        'code' => $code
    );

    // Initialize cURL
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url); // Correctly set the URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo json_encode(array('output' => 'Error: ' . curl_error($ch)));
    } else {
        // Decode the response
        $decodedResponse = json_decode($response, true);

        // Check if the 'output' field exists in the response
        if (isset($decodedResponse['output'])) {
            $output = array('output' => $decodedResponse['output']);
        } else {
            // Output the full response for debugging if 'output' is not found
            $output = array('output' => 'Invalid response or no output', 'response' => $decodedResponse);
        }
        echo json_encode($output);
    }

    // Close the cURL session
    curl_close($ch);
?>
