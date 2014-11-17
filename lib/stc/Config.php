<?php

namespace STC;

class Config
{
  static private $is_init     = false;
  static private $root_folder = '';
  static private $data_folder = '';
  static private $site        = null;
  static private $files       = [];

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

    // loading data files.
    $files = array_diff(
      scandir(self::$data_folder),
      array('..', '.')
    );
    self::load_data_files($files);

    // boot app.
    self::$is_init = true;

    return self::$is_init;
  }

  static private function load_data_files($files = [])
  {
    $data_loader = new DataLoader();

    foreach($files as $file) {
      self::$files[] = $data_loader->load(self::$data_folder, $file);
    }
  }

  static public function site()
  {
    return self::$site;
  }

  static public function files()
  {
    return self::$files;
  }
}
