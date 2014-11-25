<?php

namespace STC;

/**
 * @author Bruno Dias <dias.h.bruno@gmail.com>
 * @license MIT License (see LICENSE)
 */
class Application
{
  /**
   * Already initialized?
   * @var bool
   */
  static private $is_init = false;

  /**
   * Root path where the data is stored.
   * @var string
   */
  static private $root_folder = '';
  /**
   * Data path where posts and pages are stored.
   * @var string
   */
  static private $data_folder = '';

  /**
   * Instance of the application.
   * @var Site
   */
  static private $app = null;

  /**
   * Store all database components instances.
   * @var object
   */
  static private $dbs = array();

  /**
   * Store all writers instances.
   * @var object
   */
  static private $writers = array();

  /**
   * Initializes the engine.
   * @param $root string | The root where the data is stored.
   * @param $data_folder string | The data where the posts and pages are stored.
   * @return bool
   */
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
    self::$app = new DataApplication(self::$data_folder);

    // boot app.
    self::$is_init = true;

    return self::$is_init;
  }

  /**
   * Register a new writers.
   * @param $instance object | A writer instance.
   */
  static public function register_writer($instance)
  {
    if ($instance == null) {
      throw new \Exception('Instance is null.');
    }
    self::$writers[] = $instance;
  }

  /**
   * Register a new database component.
   * @param $instance object | A database component instance.
   */
  static public function register_database($instance)
  {
    if ($instance == null) {
      throw new \Exception('Instance is null.');
    }
    self::$dbs[] = $instance;
  }

  /**
   * Run...
   * Execute the execute method in each database component, to generate data.
   * Execute the execute method in each writer to write pages.
   * @return void
   */
  static public function run()
  {
    foreach (self::$dbs as $db) {
      $db->execute(self::files());
    }

    foreach (self::$writer as $writer) {
      $writer->execute(self::files());
    }
  }

  /**
   * Returns the data folder.
   * @return string
   */
  static public function data_folder()
  {
    return self::$data_folder;
  }

  /**
   * Returns the site instance.
   * @return Site
   */
  static public function config()
  {
    return self::$app->config;
  }

  /**
   * Returns the templates instance.
   * @return Templates
   */
  static public function templates()
  {
    return self::$app->templates;
  }

  /**
   * Returns the files instance.
   * @return Files
   */
  static public function files()
  {
    return self::$app->files;
  }

  /**
   * Returns the database instance.
   * @return Files
   */
  static public function db()
  {
    return self::$app->db;
  }
}
