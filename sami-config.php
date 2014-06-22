<?php

$versions = \Sami\Version\GitVersionCollection::create(__DIR__.'/src')
    ->addFromTags('1.*')
    ->add('master', 'Master Branch');

return new \Sami\Sami(__DIR__.'/src', [
    'theme'                 => 'enhanced',
    'versions'              => $versions,
    'title'                 => 'Counterpart API',
    'build_dir'             => __DIR__.'/sami/build/%version%',
    'cache_dir'             => __DIR__.'/sami/cache/%version%',
    'default_opened_level'  => 2,
]);
