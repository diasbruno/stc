<?php

namespace STC;

class Config
{
  static private $is_init     = false;

  static private $root_folder = '';
  static private $data_folder = '';

  static private $site        = null;
  static private $templates   = null;
  static private $files       = null;

  static private $components  = [];
  static private $storage     = [];

  static private $renders     = [];

  static public function bootstrap($root = '', $data_folder = '')
  {
    if (self::$is_init) { return self::$is_init; }

    if ($root != '') {
      self::$root_folder = $root;
    } else {
      throw new \Exception('Root folder must be setted.');
    }

    if ($data_folder != '') {
      self::$data_folder = self::$root_folder . '/' . $data_folder;
    } else {
      throw new \Exception('Data folder must be setted.');
    }

    // load the config file.
    self::$site = new Site();
    self::$site->load(self::$data_folder);

    // load the templates.
    self::$templates = new Templates();
    self::$templates->load(self::$data_folder);

    // loading data files.
    self::$files = new Files();
    self::$files->load(self::$data_folder);

    // boot app.
    self::register_component(new PageComponent);
    self::register_render(new PageRender);
    self::$is_init = true;

    return self::$is_init;
  }

  static public function register_render($instance)
  {
    self::$renders[] = $instance;
  }

  static public function register_component($instance)
  {
    self::$components[] = $instance;
  }

  static public function store_data($key, $value)
  {
    self::$storage[$key] = $value;
  }

  static public function retrive_data($key)
  {
    if (array_key_exists($key, self::$storage)) {
      return self::$storage[$key];
    }

    return [];
  }

  static public function run()
  {
    foreach (self::$components as $component) {
      $component->build(self::files());
    }
    foreach (self::$renders as $render) {
      $render->render(self::files());
    }
  }

  static public function data_folder()
  {
    return self::$data_folder;
  }

  static public function site()
  {
    return self::$site;
  }

  static public function templates()
  {
    return self::$templates;
  }

  static public function files()
  {
    return self::$files;
  }
}
