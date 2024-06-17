<?php
  function sumInput($input){
    $data = strval($input);
    $sum = 0;
    for($i = 0; $i < strlen($data); $i++){
      $sum += (int)$data[$i];
    }
    return $sum;
  }
  
  $input = readline('Please enter your number: ');
  echo 'Output: '. sumInput($input);
?>
