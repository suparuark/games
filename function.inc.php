<?php
	function select($field, $table, $continue) {
		return "select ".$field." from ".$table." ".$continue;
	}

	function query($conn, $sql) {
		return mysqli_query($conn, $sql);
	}

	function fnum($result) {
		return mysqli_num_rows($result);
	}

  function fobj($result) {
    return mysqli_fetch_object($result);
  }

	function ffetch($result) {
		return mysqli_fetch_array($result);
	}

	function fescape($conn, $sql) {
		return mysqli_real_escape_string($conn, $sql);
	}

	function md($md, $pass) {
		return md5(sha1(md5($md).md5($pass)));
	}

	function sbstr($a, $b, $c) {
		return iconv_substr($a, $b, $c, "UTF-8");
	}

	function numfor($a, $b) {
		return number_format($a, $b, ".", ",");
	}

	function math1($a) {
		$a1 = array("", "A", "I", "J", "Q", "Y");
	  $a2 = array("", "B", "K", "R");
	  $a3 = array("", "C", "G", "L", "S");
	  $a4 = array("", "D", "M", "T");
	  $a5 = array("", "E", "H", "N", "X");
	  $a6 = array("", "U", "V", "W");
	  $a7 = array("", "O", "Z");
	  $a8 = array("", "F", "P");
		$x1 = strtoupper($a);
	  $y1 = strlen(trim($x1));
	  for ($c1=0; $c1<trim($y1); $c1++) {
	    $y2 = iconv_substr(trim($x1), $c1, 1, "UTF-8");
	    $b1 = array_search(trim($y2), $a1);
	    $b2 = array_search(trim($y2), $a2);
	    $b3 = array_search(trim($y2), $a3);
	    $b4 = array_search(trim($y2), $a4);
	    $b5 = array_search(trim($y2), $a5);
	    $b6 = array_search(trim($y2), $a6);
	    $b7 = array_search(trim($y2), $a7);
	    $b8 = array_search(trim($y2), $a8);
	    $b9 = array_search(trim($y2), $a9);
	    if (trim($b1)<>"") {
	      $d = 1;
	    } else {
	      if (trim($b2)<>"") {
	        $d = 2;
	      } else {
	        if (trim($b3)<>"") {
	          $d = 3;
	        } else {
	          if (trim($b4)<>"") {
	            $d = 4;
	          } else {
	            if (trim($b5)<>"") {
	              $d = 5;
	            } else {
	              if (trim($b6)<>"") {
	                $d = 6;
	              } else {
	                if (trim($b7)<>"") {
	                  $d = 7;
	                } else {
	                  if (trim($b8)<>"") {
	                    $d = 8;
	                  } else {
	                    if (trim($b9)<>"") {
	                      $d = 9;
	                    } else {
	                      $d = 0;
	                    }
	                  }
	                }
	              }
	            }
	          }
	        }
	      }
	    }
	    $e = trim($e)+trim($d);
	  }
	  return trim($e);
	}

	function numthai($a) {
		switch ($a) {
			case ($a==""): $b="๐"; break;
			case ($a==0 || $a=="๐"): $b="๐"; break;
			case ($a==1 || $a=="๑"): $b="๑"; break;
			case ($a==2 || $a=="๒"): $b="๒"; break;
			case ($a==3 || $a=="๓"): $b="๓"; break;
			case ($a==4 || $a=="๔"): $b="๔"; break;
			case ($a==5 || $a=="๕"): $b="๕"; break;
			case ($a==6 || $a=="๖"): $b="๖"; break;
			case ($a==7 || $a=="๗"): $b="๗"; break;
			case ($a==8 || $a=="๘"): $b="๘"; break;
			case ($a==9 || $a=="๙"): $b="๙"; break;
		}
		return $b;
	}

	function upper($a) {
		return strtoupper($a);
	}

	function lower($a) {
		return strtolower($a);
	}
?>
