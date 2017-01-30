<?php
function savehtml($input){
  $savehtml = trim(htmlspecialchars($input, ENT_QUOTES));
  return $savehtml;
}
?>