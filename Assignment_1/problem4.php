<?php
  function triangle($n) {
      $k = 2 * $n - 2;
      for ($i = 0; $i < $n; $i++) {
          for ($j = 0; $j < $k; $j++)
              echo " ";
          $k = $k - 1;
          for ($j = 0; $j <= $i; $j++ ) {
              echo "* ";
          }
          echo "\n";
      }
  }
  
  $input = (int)readline('Please enter your number: ');
  triangle($input);
  ?>
