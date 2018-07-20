<?php
  header("Access-Control-Allow-Origin: *");
  $meJson = '{';
  $meJson .= '"people": [';
  $meJson .= '"Index", "Joe", "Tony", "Caleb"';
  $meJson .= ']';
  $meJson .= '}';
  echo $meJson;
?>