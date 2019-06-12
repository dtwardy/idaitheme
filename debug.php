<?php
function debugToConsole( $data ) {

    if ( is_array( $data ) ){
      $output = "<script>console.log( 'DEBUG: " . implode( ',', $data) . "' );</script>";
    } else {
      $output = "<script>console.log( 'DEBUG: " . $data . "' );</script>";
    }
        echo $output;
  }
?>