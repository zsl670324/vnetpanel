<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');