<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('DBDFC5B74756CBC2AAQAAAAXAAAABJAAAACABAAAAAAAAAD/SV5L7wNXVn6W4Gskdt5/rzRPMbBBSCczZcM/093nsFam1WkZ+AQl+OTzsrVSO1ISeTJbxfGiBtR0okKIgyVaNjrP+m/il5rGby11jQMxNFKUG/CDLq1+O3rabEk4iiF7q5RIzLjaN78QNYvi+52HYg+dd80d+wd0cMFNCdzrfg+fpxCJ0HIMdllgJ/No6F0GSQAAAKgBAABaM3xIX+msSKn2vUUb5qXh6htLWWv2TYVv8pGwkpP1jrg9kka8V4hHc864vSiEinv997eGom9HTANPzkIWgA5HpebH4FVsLcLzVX04qVGCAvGS8cvVkWaOSv/mZDIA4OSbzBKEwXS00XvNg3jxSKzxOS/44vj1Dk2DBPCG/BldU1VcIjB5K9s9yCztnXOU1rl3t8Io0WlvOLL7vH8VVCjGVTxzd2NUQ4YoXFt7DEV8RRHt1Sf/u/Ws/b7zqFYDsQBbalm0Fuer6cPK793c/RHA9sYXTFvVZukmnpJMk2WUBb8nfpDYkAURZ+duMVXhD5/QUOaR7PJ0+95FVurFS24H6ErTAKI945kyzbQzXPfhoW3xwa7iycxefPmrB/SidkROO2Oh/Iitv0338oFShl3w9PNlREDcjAflVGjk+enZSu9Mz8B6chqvOY/bl9Xe0dnzvnTfzn4cJNxzqWkrEotiEEzj1RdcFkAohVU/phTWR0n4tz+eqSAEGtZzw7oYbL9BrG21rAp1AwZ4r5ofH5eloKjO8+ZrTMwEuVq/Y0Ek2fStBscc0hliSgAAALABAABZL9vI9Jz3pE5u6sxm2LJNyD+i/Oi0RddigCFWvgkFcIwLjgtwRgc9+YlzFdFMBxU6vzrRORD1NwO3sOCmIutpbWtbwIHUBsTty6i1cb2V8TTXBKBQypM6NKmUoC5LDuplnf75oB73+tRWiwD/thJXTo1np2CHBUmTzMk4yjR9isZoCuI/lYekXOJkyR6SI69/g/BbOJQiNOIlS6MSH/xBuVKaKQX2/B4H5hFK7BH3w1eNXgMsFktrh9dr7AAWsTWE6ihyocTOcmQsp4am8cGjesGTF10MqS4jkPqu03zwQwUOmhpK+W7p/HJ6at+v+HoOuNhAtOTF1qmxCREGaTJhoKCPE0LlNTd/S3uAepuzNg5CUU6nx1dUIrTdhi16BZDbtaDXaMTcXym7q234jU4G2/5Mr8o4DKzjHiVVWZ2Rna22xM8UOy6MuIFeHwXSBk7KwAHmSgtPEdGPuurRAubzQW8O2bURogaGE+5NRFZnvN0XTwZYg+48aOHdcwSb54+FZl5ZCLxfutUlAn6QrYC/mWG9ejwgD+2t51KuWodsw8LhkbUkdSOGng07+oEGUegAAAAA');