<?php

echo "Enter a number: ";
$number = (int)readline();

if ($number > 0){
    if ($number % 2 == 0){
        echo "The number $number is positive and even";
    }
    else{
        echo "The number $number is positive and odd";
    }
}
else{
    if ($number % 2 == 0){
        echo "The number $number is negative and even";
    }
    else{
        echo "The number $number is negative and odd";
    }
    
}
