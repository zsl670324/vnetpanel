<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');