<?php
function flag($country){
  if (strtolower($country) == "cameroon") {
    return "cm.png";
  }elseif (strtolower($country) == "gabon") {
    return "gb.png";
  }elseif (strtolower($country) == "nigeria") {
    return "ng.png";
  }
  return "";
}


 ?>
