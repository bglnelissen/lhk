<?php

if(! is_readable($_SESSION['stylesheet'])){
  $_SESSION['stylesheet']="css/markdown.css";
  debugmsg(__FILE__."(".__LINE__.")".": Stylesheet NOT found, using default: ".$_SESSION['stylesheet']);
}else{
	debugmsg(__FILE__."(".__LINE__.")".": Stylesheet found: ".$_SESSION['stylesheet']);
}
?>

