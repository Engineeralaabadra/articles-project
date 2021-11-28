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
/**
 * @param string $moduleName
 * @return string
 */
function buildControllerNamespace(string $moduleName){
  // return ucfirst($moduleName).'Http\Controllers';
  return 'Articles\Http\Controllers';
}
