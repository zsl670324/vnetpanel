<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');