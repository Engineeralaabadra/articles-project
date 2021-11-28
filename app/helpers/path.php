<?php
function getModuleName(string $moduleName){
    return app_path('modules'.DS().$moduleName.DS());
}
function loadConfigFile(string $filename,string $moduleName){
   // return __DIR__.DS().'..'.DS().'config'.DS().$filename.'php';
    return getModuleName($moduleName).'config'.DS().$filename.'php';
}
function loadRoute(string $filename,string $moduleName){
   // return __DIR__.DS().'..'.DS().'routes'.DS().'admin'.DS().$filename.'php';
    return getModuleName($moduleName).'routes'.DS().'admin'.DS().$filename.'php';
}

function loadViews(string $moduleName){
   // return __DIR__.DS().'..'.DS().'resources'.DS().'views';
    return getModuleName($moduleName).'resources'.DS().'views';
}
function loadMigrations(string $moduleName){
   // return __DIR__.DS().'..'.DS().'database'.DS().'migrations';
    return getModuleName($moduleName).'database'.DS().'migrations';
}
function loadTranslations(string $moduleName){
   // return __DIR__.DS().'..'.DS().'resources'.DS().'lang';
    return getModuleName($moduleName).'resources'.DS().'lang';
}

function DS(){
    return DIRECTORY_SEPARATOR;
}