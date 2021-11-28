<?php
/**
 * @param string $moduleName
 * @param string $type
 * @return string
 */
function buildPrefix(string $moduleName,string $type='admin'){
    // config('articles.prefix.admin',config('module.prefix.admin')).'/'.config('articles.module-name');
  return  config($moduleName.'.prefix.admin',config('module.prefix.'.$type)).'/'.config($moduleName.'.module-name');
}