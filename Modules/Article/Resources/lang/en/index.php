$ds=DIRECTORY_SEPARATOR;
        $moduleName='articles';
        config([
            'articles'=>FacadesFile::getRequire(__DIR__.$ds.'..'.$ds.'config'.$ds.'route.php')
            ]);