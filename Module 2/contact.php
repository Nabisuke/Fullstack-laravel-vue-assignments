<?php

$contacts = [];

function addContact(array &$contacts, string $name, string $email, string $number): void
{
    $contacts[] = ["name" => $name, "email" => $email, "number" => $number];

}

function displayContacts(array $contacts): void
{
    if (empty($contacts)) {
        echo "No contact available \n";
        return;
    }
    else{
        foreach ($contacts as $index => $contact) {
            echo "Contact " . ($index + 1) . ":\n";
            echo "Name: {$contact['name']}\n";
            echo "Email: {$contact['email']}\n";
            echo "Number: {$contact['number']}\n";
            echo "------------------------\n";
        }
    }
    
}

while(true){
    echo "1. Add Contact\n2. View Contacts\n3. Exit\n";
    $choice = (int)readline("Choose an option: ");

    switch ($choice) {
        case '1':
            $name = (string)readline("Enter Name: ");
            $email = (string)readline("Enter Email: ");
            $number = (string)readline("Enter Number: ");
            addContact($contacts, $name, $email, $number);
            echo "Contact added successfully!\n";
            echo "------------------------\n";
            break;
        case '2':
            displayContacts($contacts);
            break;
        case '3':
            echo "Exiting...\n";
            break;
        default:
            echo "Invalid choice. Please try again.\n";
    }
}