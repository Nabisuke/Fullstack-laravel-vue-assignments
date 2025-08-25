<?php

const FACTOR = 9/5;
const OFFSET = 32;

echo "Enter Your Temperature: ";
$temperature = (int)readline();

echo "Convert to (F: Fahrenheit), (C: Celsius): ";
$choice = readline();

switch($choice){
    case "F":
        $result = $temperature * FACTOR + OFFSET;
        echo "Temperature in Fahrenheit : $result";
        break;

    case "C":
        $result = ($temperature - OFFSET) / FACTOR;
        echo "Temperature in Celsius : $result";
        break;

    default:
    echo "Invalid Choice";
    break;

}