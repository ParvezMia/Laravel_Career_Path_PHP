<?php
  function transformedSentence($input) {
    $words = explode(' ', $input);
    
    foreach ($words as &$word) {
        $word = strrev($word);
    }
    
    return implode(' ', $words);
  }
  
  $input = readline('Please enter your text: ');
  
  echo "Original Sentence: " . $input . "\n";
  echo "Transformed Sentence: ". transformedSentence($input);
  
?>
