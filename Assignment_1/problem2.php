<?php
  function wordCount($input) {
    $data  = explode(' ', $input);
    return count($data);
  }
  $filename = 'file.txt'; 
  $fileContent = file_get_contents($filename);
  
  if ($fileContent === false) {
    $input = readline('Please enter your text: ');
    echo "Number of Word is : ". wordCount($input);
  } else {
      $wordCount = wordCount($fileContent);
      echo "Number of Words is: " . $wordCount;
  }
  
?>
