<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('DBDFC5B74756CBC2AAQAAAAXAAAABJAAAACABAAAAAAAAAD/a3LInwtlTi76XNIXLYKZnopw7kcnJebZmIVUCXkGkiWUeb1KPgI7NS15RPxAoGSlfc1X7Hb6G76lnkrWkVWGad0JFsfMm2D34BuE7jHz1etJbJcA858jaeMcOKwqRMoDip6ZUPjJ86er+ftAOXdS0LJNbf99M+lo+0j8fVgavUh8Bkj8GTm/EivzgQSFJO+aSQAAAJACAADPXdKbYK7CyUnc9yHK2JiVfsDwZIARszsjsY2txrkOt2Jfedyrtjj5+ljSUoiQHidbVFTgfjahCbgwX8silZVmhPXUX0jNsS3xQr0cp2RiXeKWKBthO2m9lHmyRkle7LTRKeZI5zB1bdGWR025liaEpBzWWJiYLuQBwx6kCl2JIG8CToS4aJxoOVloWVk/Jmpvls+ZWENL65I0YUFVRVDZV6QHpJ+YYLlEHFhWwGEDKFnMxynG5cOfHgRzwQB5dixYIiWlrEZfLaHZrLuukXy2EptJmpIqr+XUIy8UGquE+zb0D4WXCAcGSMKRB1UUJEcaCs4A540agPPHCsL5mt04LNVNBotx23kZghfPGTFc+wdmrMNp+c9jEQ/g7CaKyxTfvAlHF4f7t6XFMxLEK28M15a17zqN535T2b6gGlvmrUfsscbYfZC4MV9jm7oEQroZN0j6Fig4vGSK8iyOAhPBWdBweJ8FI5x/mIG3ZxcmzOb6v+fWqH0QA/64vkVch77wckCH9MbU5SIXtPQJQUSBeBWblvBRmCJuPC/92Nqq9gpVaLdw0PS4Z2pLbLxoVKqv+Lu5QJyDpFEKlpv9A07fqzBkx42MjKPQG5HOihMdJ2d2kr2M5dOt+aOzJ0uyoioiOtIHwCy+70649WYz6fjxCu2pAnCGOj78ykUJ+Rtd0SNNmpdpTT8fgi/MAd7ZaxHwMHI5UhsXbUGV9zhg6o8kTbQtr4ZPPlO0rAgO/4HfxJPjtyA9yGwQJuaBgINqLgred0yYnapMXvY2wHrxJOvH1PimvSKcZlCGY2D8gbUO1cgwcnQC4Wo14hRyV0Vy0nrmMsA5kU9YIioLr3fbG1he7+guvnQWTRWDx23tOoyIQ0oAAACAAgAAiEU5SLnXDvjVmQ95Zr06vpFLxcf7AW/JxbsFtgKxIpIBYZE4j+RVuj+mDxgmSekAawqiTYnY4KibCm26p9HK4upOQ8KVP8vwBqggOrZ8HdrXGrZwdwKCfsRzroy9WAMMmkv4Nn+U5lMD0Vkt8bg9nDj3bP4QueWZSI7Mcm/BoE25AVJIvo0DxYb501imQDiZIPizxhgwTOuHVi7FaXd+csMcy/Jka432bT0/lkyLF+nCCcn6LzwmybuNYYo0aNOtFt2zCVzIxBvrmd5C12NhrTB6s1O3Q302N0Gcs5CDlxIT476sePvWqnsKYHHnbTir2urd5vT2ZiV6c/zt9s8BPJrvO/ZMYEyb0xwu/L2OHTmFDv2HZM4SAJ5Rf2cqHyDlcuCkIGdUmEhi6yhfZWVOze7pJFqnYeYdA+JofFyFm+cIRKUhDE3n0eroUoig3aV2yXhK6JmNd9S9MJ86hc7sLwbAZ0x4Ti7vGZU0WF6KvE1dqOkWKrjKCZI+sRyqAtr5QgWNDn/L7bocOrLYgOXwoOj15CcuN0pm49ZOaK4WsWiRpanrRthziVcN7lg2KbV0aDaEBEm0Debv63/TM3DI4IvJFMWMuWg/zam5WGi92+o8YzVq00W9xQbODp6y0GPyO6gENgvoifhv7q6JynKajw3xR3evs4irByRrZTLHpe4DY2OwiSYYmccWs/d8Qd0UYI4KvSFE47iMofMYgTO9NakRvbnDmr4RRwl217Poe1EFVh4b8BLNn0JFyOld/5TTqdULFDsoSwnhaoQKvFcVhCQuW7LnV2Dj0WY5Q1RUY0feEUgPd04jEfOGtEWW9LIKcAohXqaeaLmlT3cDe4fK0QAAAAA=');