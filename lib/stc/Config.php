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
    self::$is_init = true;

    return self::$is_init;
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
