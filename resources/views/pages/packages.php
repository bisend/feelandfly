<?php return array (
  'barryvdh/laravel-debugbar' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\Debugbar\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'Debugbar' => 'Barryvdh\\Debugbar\\Facade',
    ),
  ),
  'barryvdh/laravel-ide-helper' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider',
    ),
  ),
  'browner12/helpers' => 
  array (
    'providers' => 
    array (
      0 => 'browner12\\helpers\\HelperServiceProvider',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'htmlmin/htmlmin' => 
  array (
    'providers' => 
    array (
      0 => 'HTMLMin\\HTMLMin\\HTMLMinServiceProvider',
    ),
    'aliases' => 
    array (
      'HTMLMin' => 'HTMLMin\\HTMLMin\\Facades\\HTMLMin',
    ),
  ),
  'laracasts/utilities' => 
  array (
    'providers' => 
    array (
      0 => 'Laracasts\\Utilities\\JavaScript\\JavaScriptServiceProvider',
    ),
    'aliases' => 
    array (
      'JavaScript' => 'Laracasts\\Utilities\\JavaScript\\JavaScriptFacade',
    ),
  ),
  'laravel/socialite' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Socialite\\SocialiteServiceProvider',
    ),
    'aliases' => 
    array (
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'laravelrus/localized-carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Laravelrus\\LocalizedCarbon\\LocalizedCarbonServiceProvider',
    ),
    'aliases' => 
    array (
      'LocalizedCarbon' => 'Laravelrus\\LocalizedCarbon\\LocalizedCarbon',
      'DiffFormatter' => 'Laravelrus\\LocalizedCarbon\\DiffFactoryFacade',
    ),
  ),
);