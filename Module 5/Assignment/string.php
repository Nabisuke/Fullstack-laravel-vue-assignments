<?php
echo "Enter some strings: ";
$strings = trim(fgets(STDIN));
$array = explode(" ",$strings);
foreach ($array as $arr){
    $upper = strtoupper($arr);
    $cnt = 0;
    for ($i= 0; $i < strlen($upper); $i++){
        if($upper[$i] != 'A' && $upper[$i] != 'E' && $upper[$i] != 'I' &&
            $upper[$i] != 'O' && $upper[$i] != 'U'){
            $cnt++;
        }
    }
    echo "Original String: {$arr}, Consonant Count: {$cnt}, Uppercase String: {$upper}";
    echo "\n";

}

?>