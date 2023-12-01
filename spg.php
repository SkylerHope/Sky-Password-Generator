<?php

// Function to generate a password with specified length and optional inclusion of numbers and symbols
function generatePassword($len = 0, $includeNumbers = true, $includeSymbols = true) {
    // Define character sets for different types of characters
    $upperCaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowerCaseLetters = 'abcdefghijklmnopqrstuvwyz';
    $numbers = '0123456789';
    $symbols = '!@#$%^&*()-_+=<>?';

    // Initialize character set with uppercase and lowercase letters
    $characters = $upperCaseLetters . $lowerCaseLetters;

    // Include numbers in the character set if specified
    if($includeNumbers == true) {
        $characters .= $numbers;
    }

    // Include symbols in the character set if specified
    if($includeSymbols == true) {
        $characters .= $symbols;
    }

    // Initialize password variable
    $password = '';

    // Calculate the length of the character set
    $charactersLen = strlen($characters);

    // Generate password by randomly selecting characters from the character set
    for($i = 0; $i < $len; $i++) {
        $password .= $characters[rand(0, $charactersLen - 1)];
    }

    // Return the generated password
    return $password;
}

// Display program title
echo "\n            ,-.----.               
  .--.--.   \    /  \    ,----..   
 /  /    '. |   :    \  /   /   \  
|  :  /`. / |   |  .\ :|   :     : 
;  |  |--`  .   :  |: |.   |  ;. / 
|  :  ;_    |   |   \ :.   ; /--`  
 \  \    `. |   : .   /;   | ;  __ 
  `----.   \;   | |`-' |   : |.' .'
  __ \  \  ||   | ;    .   | '_.' :
 /  /`--'  /:   ' |    '   ; : \  |
'--'.     / :   : :    '   | '/  .'
  `--'---'  |   | :    |   :    /  
            `---'.|     \   \ .'   
              `---`      `---`     \n\n\n\n";

// Initialize flags for including numbers and symbols
$includeNumbers = true;
$includeSymbols = true;

// Prompt user for the length of the password
$lenInput = readline("Length of password: ");

// Validate the length input to ensure it is a positive integer
while(!is_numeric($lenInput) || intval($lenInput) <= 7) {
    echo "Invalid input. Please provide a number (Must be 8 or above)\n";
    $lenInput = readline("Length of password: ");
} 

// Convert the validated length input to an integer
$len = intval($lenInput);

// Prompt user for including numbers
$numbersInput = readline("Include numbers? [y/n]: ");

// Validate the input for including numbers
while($numbersInput !== 'y' && $numbersInput !== 'n') {
    $numbersInput = readline("Invalid input, include numbers? [y/n]: ");
}

// Update the flag based on user input
if($numbersInput == 'n') {
    $includeNumbers = false;
}

// Prompt user for including symbols
$symbolsInput = readline("Include symbols? [y/n]: ");

// Validate the input for including symbols
while($symbolsInput !== 'y' && $symbolsInput !== 'n') {
    $symbolsInput = readline("Invalid input, include symbols? [y/n]: ");
}

// Update the flag based on user input
if($symbolsInput == 'n') {
    $includeSymbols = false;
}

// Generate the password using the provided options
$password = generatePassword($len, $includeNumbers, $includeSymbols);

// Display the generated password
echo "\nGenerated Password: $password\n\n";

// Ask user to store the password locally [NEW]
$saveToPasswordFile = readline("Save password to passwords.txt? [y/n]: ");

// Keep asking to save the password if the user provides invalid input [NEW]
while($saveToPasswordFile !== 'y' && $saveToPasswordFile !== 'n') {
    $saveToPasswordFile = readline("Invalid input, store password to passwords.txt? [y/n]: ");
}

// Check if user wants to save the password locally [NEW]
if($saveToPasswordFile == 'y') {
    // Store the password in a txt file [NEW]
    $generatedPassword = "\n$password\n";
    $passwordFile = fopen('passwords.txt', 'a');
    fwrite($passwordFile, $generatedPassword);
    fclose($passwordFile);
    // Prompt user to exit the program after saving the password [NEW]
    $exitText = readline("Password Saved! Press any key to exit...\n");
} else {
    exit;
}

?>