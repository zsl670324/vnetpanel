<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');