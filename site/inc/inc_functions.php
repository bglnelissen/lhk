<?php
// create save html text
function savehtml($input){
  $savehtml = trim(htmlspecialchars($input, ENT_QUOTES));
  return $savehtml;
}

// debug
// set TRUE and FALSE for debugging here.
function debugmsg($input){
  if (false){
    echo "<p class=\"debug\">".$input."</p>";
  }
}

?>