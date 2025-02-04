<?php
  $link = mysqli_connect("localhost", "root", "12345678", "question");
  mysqli_set_charset($link, "utf8");
  define("index", "https://games.phoonzone.com/");
  include "function.inc.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>แบบทดสอบจิตวิทยา</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.phoonzone.com/bootstrap/css/bootstrap462.min.css" />
  <link rel="stylesheet" href="https://www.phoonzone.com/bootstrap/css/lightbox2114.min.css" />
  <script src="https://www.phoonzone.com/bootstrap/js/jquery371.slim.min.js"></script>
  <script src="https://www.phoonzone.com/bootstrap/js/popper1161.min.js"></script>
  <script src="https://www.phoonzone.com/bootstrap/js/bootstrap462.bundle.min.js"></script>
</head>

<body>
  <div class="container">
    <div class="jumbotron text-center font-weight-bold bg-info text-dark">
      <h2>แบบทดสอบจิตวิทยา</h2>
    </div>
<?php
  if (trim($_REQUEST['x'])=="") {
    if (trim($_REQUEST['y'])=="") {
      $qa1 = sprintf(select("*", "%s", "order by %s asc"),
        fescape($link, "m_quest"), fescape($link, "id"));
      $qa2 = query($link, $qa1);
      $qa3 = fnum($qa2);
      if ($qa3 > 0) {
        $qa5 = 0;
        while ($qa4 = ffetch($qa2)) {
          $qa5++;
?>
    <div class="row p-2">
      <div class="col-md-12">
        <?php echo trim($qa5);?>.
        <a href="<?php echo index;?>quest/<?php echo trim($qa4['id']);?>.html" class="">
          <?php echo trim($qa4['quest']);?>
        </a>
      </div>
    </div>
<?php
        }
      }
?>

<?php
    } else if (trim($_REQUEST['y'])=="quest") {
      $id = trim($_REQUEST['id']);
      if (trim($id)=="3") {
        $x = "2";
      } else {
        $x = "1";
      }
      $qa1 = sprintf(select("*", "%s", "where %s='%s'"), fescape($link, "m_quest"),
        fescape($link, "id"), fescape($link, trim($id)));
      $qa2 = query($link, $qa1);
      $qa3 = ffetch($qa2);
?>
    <div class="row p-3">
      <div class="col-md-12 font-weight-bold text-primary">
        <h4><?php echo trim($qa3['quest']);?></h4>
      </div>
    </div>
    <form action="<?php echo index;?>question.html" method="post">
      <input type="hidden" name="x" value="<?php echo trim($x);?>" />
      <input type="hidden" name="id_quest" value="<?php echo trim($id);?>" />
<?php
      $qb1 = sprintf(select("*", "%s", "where %s='%s' order by rand()"), fescape($link, "m_question"),
        fescape($link, "id_quest"), fescape($link, trim($id)));
      $qb2 = query($link, $qb1);
      $qb3 = fnum($qb2);
      if ($qb3 > 0) {
        $qb4 = 0;
?>
      <input type="hidden" name="num" value="<?php echo trim($qb3);?>" />
<?php
        while ($qb5 = ffetch($qb2)) {
          $qb4++;
?>
      <input type="hidden" name="id_question[]" value="<?php echo trim($qb5['id']);?>" />
      <div class="row p-1">
        <div class="col-md-12">
          <h5>
            <small>
              <?php echo trim($qb4);?>.
              <?php echo trim($qb5['question']);?>
            </small>
          </h5>
        </div>
        <div class="col-md-12 p-3">
<?php
          $qc1 = sprintf(select("*", "%s", "where %s='%s' && %s='%s' order by rand()"),
            fescape($link, "m_answer"),
            fescape($link, "id_quest"), fescape($link, trim($id)),
            fescape($link, "id_question"), fescape($link, trim($qb5['id'])));
          $qc2 = query($link, $qc1);
          $qc3 = fnum($qc2);
          if ($qc3 > 0) {
            $qc5 = 0;
            while ($qc4 = ffetch($qc2)) {
              $qc5++;
              if (trim($qc5)==1) {
                $qc6 = "checked=\"checked\"";
              } else {
                $qc6 = "";
              }
?>
          <input type="radio" name="answer<?php echo trim($qb4)-1;?>" value="<?php echo trim($qc4['id']);?>" <?php echo trim($qc6);?>>
          <?php echo trim($qc4['answer']);?><br />
<?php
            }
          }
?>
        </div>
      </div>
<?php
        }
      }
?>
      <div class="text-center">
        <input type="submit" name="ok" value="ทำนาย" class="btn btn-danger" />
        <a href="<?php echo index;?>question.html" class="btn btn-info">
          เลือกหัวข้อใหม่
        </a>
      </div>
    </form>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php
    }
  } else if (trim($_REQUEST['x'])=="1") {
    $id_quest = trim($_REQUEST['id_quest']);
    $num = trim($_REQUEST['num']);
    $qa1 = sprintf(select("*", "%s", "where %s='%s'"),
      fescape($link, "m_quest"),
      fescape($link, "id"), fescape($link, trim($id_quest)));
    $qa2 = query($link, $qa1);
    $qa3 = ffetch($qa2);
?>
    <div class="row p-3">
      <div class="col-md-12 font-weight-bold text-primary">
        <h4><?php echo trim($qa3['quest']);?></h4>
      </div>
    </div>
<?php
    $score = 0;
    for ($i=0; $i<trim($num); $i++) {
      $qb1 = sprintf(select("*", "%s", "where %s='%s'"),
        fescape($link, "m_question"),
        fescape($link, "id"), fescape($link, trim($_REQUEST['id_question'][$i])));
      $qb2 = query($link, $qb1);
      $qb3 = ffetch($qb2);
      $qc1 = sprintf(select("*", "%s", "where %s='%s'"),
        fescape($link, "m_answer"),
        fescape($link, "id"), fescape($link, trim($_REQUEST['answer'.$i])));
      $qc2 = query($link, $qc1);
      $qc3 = ffetch($qc2);
      $score = $score + trim($qc3['score']);
    }
    $qd1 = sprintf(select("*", "%s", "where %s='%s' && %s<='%s' && %s>='%s'"),
      fescape($link, "m_keep"),
      fescape($link, "id_quest"), fescape($link, trim($id_quest)),
      fescape($link, "score_min"), fescape($link, trim($score)),
      fescape($link, "score_max"), fescape($link, trim($score)));
    $qd2 = query($link, $qd1);
    $qd3 = ffetch($qd2);
?>
    <div class="row p-1">
      <div class="col-md-12">
        <h4>
          <small>
            <span class="font-weight-bold">
              <?php echo trim($id_quest);?>
              คุณได้ <?php echo trim($score);?> คะแนน
            </span>
            <?php echo trim($qd3['means']);?>
          </small>
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <a href="<?php echo index;?>quest/<?php echo trim($id_quest);?>.html" class="btn btn-success">
          ทำแบบทดสอบใหม่
        </a>
        <a href="<?php echo index;?>question.html" class="btn btn-info">
          เลือกหัวข้อใหม่
        </a>
      </div>
    </div>
<?php
  } else if (trim($_REQUEST['x'])=="2") {
    $id_quest = trim($_REQUEST['id_quest']);
    $num = trim($_REQUEST['num']);
    $qa1 = sprintf(select("*", "%s", "where %s='%s'"),
      fescape($link, "m_quest"),
      fescape($link, "id"), fescape($link, trim($id_quest)));
    $qa2 = query($link, $qa1);
    $qa3 = ffetch($qa2);
?>
    <div class="row p-3">
      <div class="col-md-12 font-weight-bold text-primary">
        <h4><?php echo trim($qa3['quest']);?></h4>
      </div>
    </div>
<?php
    //n = 1;
    //s = 2;
    //i = 3;
    //e = 4;
    //t = 5;
    //f = 6;
    //j = 7;
    //p = 8;
    $scN = 0;
    $scS = 0;
    $scI = 0;
    $scE = 0;
    $scT = 0;
    $scF = 0;
    $scJ = 0;
    $scP = 0;
    for ($i=0; $i<trim($num); $i++) {
      $qc1 = sprintf(select("*", "%s", "where %s='%s'"),
        fescape($link, "m_answer"),
        fescape($link, "id"), fescape($link, trim($_REQUEST['answer'.$i])));
      $qc2 = query($link, $qc1);
      $qc3 = ffetch($qc2);
      switch (trim($qc3['score'])) {
        case (trim($qc3['score'])=="1"):
          $scN=$scN+1; $scS=$scS; $scI=$scI; $scE=$scE;
          $scT=$scT; $scF=$scF; $scJ=$scJ; $scP=$scP;
          break;
        case (trim($qc3['score'])=="2"):
          $scN=$scN; $scS=$scS+1; $scI=$scI; $scE=$scE;
          $scT=$scT; $scF=$scF; $scJ=$scJ; $scP=$scP;
          break;
        case (trim($qc3['score'])=="3"):
          $scN=$scN; $scS=$scS; $scI=$scI+1; $scE=$scE;
          $scT=$scT; $scF=$scF; $scJ=$scJ; $scP=$scP;
          break;
        case (trim($qc3['score'])=="4"):
          $scN=$scN; $scS=$scS; $scI=$scI; $scE=$scE+1;
          $scT=$scT; $scF=$scF; $scJ=$scJ; $scP=$scP;
          break;
        case (trim($qc3['score'])=="5"):
          $scN=$scN; $scS=$scS; $scI=$scI; $scE=$scE;
          $scT=$scT+1; $scF=$scF; $scJ=$scJ; $scP=$scP;
          break;
        case (trim($qc3['score'])=="6"):
          $scN=$scN; $scS=$scS; $scI=$scI; $scE=$scE;
          $scT=$scT; $scF=$scF+1; $scJ=$scJ; $scP=$scP;
          break;
        case (trim($qc3['score'])=="7"):
          $scN=$scN; $scS=$scS; $scI=$scI; $scE=$scE;
          $scT=$scT; $scF=$scF; $scJ=$scJ+1; $scP=$scP;
          break;
        case (trim($qc3['score'])=="8"):
          $scN=$scN; $scS=$scS; $scI=$scI; $scE=$scE;
          $scT=$scT; $scF=$scF; $scJ=$scJ; $scP=$scP+1;
          break;
      }
    }
    if (trim($scI)==trim($scE)) {
      if (trim($_REQUEST['answer10'])=="3") {
        $sB = trim($scE);
        $vB = "E";
      } else {
        $sB = trim($scI);
        $vB = "I";
      }
    } else if (trim($scI)>trim($scE)) {
      $sB = trim($scI);
      $vB = "I";
    } else if (trim($scI)<trim($scE)) {
      $sB = trim($scE);
      $vB = "E";
    }
    if (trim($scS)==trim($scN)) {
      if (trim($_REQUEST['answer15'])=="2") {
        $sA = trim($scN);
        $vA = "N";
      } else {
        $sA = trim($scS);
        $vA = "S";
      }
    } else if (trim($scS)>trim($scN)) {
      $sA = trim($scS);
      $vA = "S";
    } else if (trim($scS)<trim($scN)) {
      $sA = trim($scN);
      $vA = "N";
    }
    if (trim($scT)==trim($scF)) {
      if (trim($_REQUEST['answer23'])=="5") {
        $sC = trim($scF);
        $vC = "F";
      } else {
        $sC = trim($scT);
        $vC = "T";
      }
    } else if (trim($scT)>trim($scF)) {
      $sC = trim($scT);
      $vC = "T";
    } else if (trim($scT)<trim($scF)) {
      $sC = trim($scF);
      $vC = "F";
    }
    if (trim($scJ)==trim($scP)) {
      if (trim($_REQUEST['answer22'])=="7") {
        $sD = trim($scP);
        $vD = "P";
      } else {
        $sD = trim($scJ);
        $vD = "J";
      }
    } else if (trim($scJ)>trim($scP)) {
      $sD = trim($scJ);
      $vD = "J";
    } else if (trim($scJ)<trim($scP)) {
      $sD = trim($scP);
      $vD = "P";
    }
    function selectionSort($arr) {
      $n = count($arr);
      for ($i = 0; $i < $n - 1; $i++) {
        $minIndex = $i;
        for ($j = $i + 1; $j < $n; $j++) {
          if ($arr[$j] < $arr[$minIndex]) {
            $minIndex = $j;
          }
        }
        if ($minIndex != $i) {
          $temp = $arr[$i];
          $arr[$i] = $arr[$minIndex];
          $arr[$minIndex] = $temp;
        }
      }
      return $arr;
    }
    $uA = [trim($vB), trim($vA)];
    $uB = [trim($vC), trim($vD)];
    $uC = [trim($vA), trim($vC)];
    $tA = selectionSort($uA);
    $tB = selectionSort($uB);
    $tC = selectionSort($uC);
    $mbti = trim($tA[0]).trim($tA[1]).trim($tB[0]).trim($tB[1]);
    $mbti2 = trim($tC[1]).trim($tC[0]);
    $g1 = [trim($sB), trim($sA)];
    $g2 = [trim($sC), trim($sD)];
    rsort($g1);
    rsort($g2);
    /*
    $qd1 = sprintf(select("*", "%s", "where %s='%s' && %s<='%s' && %s>='%s'"),
      fescape($link, "m_keep"),
      fescape($link, "id_quest"), fescape($link, trim($id_quest)),
      fescape($link, "score_min"), fescape($link, trim($score)),
      fescape($link, "score_max"), fescape($link, trim($score)));
    $qd2 = query($link, $qd1);
    $qd3 = ffetch($qd2);*/
?>
    <div class="row p-1">
      <div class="col-md-12">
        <h4>
          <small>
            <span class="font-weight-bold">
              คุณได้ <?php echo trim($mbti2).", ".trim($mbti);?><br />
              <?php echo $g1[0].", ".$g1[1].", ".$g2[0].", ".$g2[1];?>
            </span>
            <!--<?php echo trim($qd3['means']);?>-->
          </small>
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <a href="<?php echo index;?>quest/<?php echo trim($id_quest);?>.html" class="btn btn-success">
          ทำแบบทดสอบใหม่
        </a>
        <a href="<?php echo index;?>question.html" class="btn btn-info">
          เลือกหัวข้อใหม่
        </a>
      </div>
    </div>
<?php
  } else if (trim($_REQUEST['x'])=="pay") {

  } else if (trim($_REQUEST['x'])=="repair") {

  } else if (trim($_REQUEST['x'])=="delete") {

  } else if (trim($_REQUEST['x'])=="keep") {

  } else if (trim($_REQUEST['x'])=="bag") {

  }
?>
  </div>
</body>
</html>
