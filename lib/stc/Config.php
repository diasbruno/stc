<?php

namespace STC;

/**
 * @author Bruno Dias <dias.h.bruno@gmail.com>
 * @license MIT License (see LICENSE)
 */
class Config
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
   * Store all component's instances.
   * @var object
   */
  static private $components = [];

  /**
   * Store all render's instances.
   * @var object
   */
  static private $renders = [];

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
    self::$app = new Application(self::$data_folder);

    // boot app.
    self::$is_init = true;

    return self::$is_init;
  }

  /**
   * Register a new render.
   * @param $instance object | A render instance.
   */
  static public function register_render($instance)
  {
    if ($instance == null) {
      throw new \Exception('Instance is null.');
    }
    self::$renders[] = $instance;
  }

  /**
   * Register a new component.
   * @param $instance object | A component instance.
   */
  static public function register_component($instance)
  {
    if ($instance == null) {
      throw new \Exception('Instance is null.');
    }
    self::$components[] = $instance;
  }

  /**
   * Run...
   * Execute the build method in each component, to generate data.
   * Execute the render method in each render to write pages.
   * @return void
   */
  static public function run()
  {
    foreach (self::$components as $component) {
      $component->build(self::files());
    }

    foreach (self::$renders as $render) {
      $render->render(self::files());
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
  static public function site()
  {
    return self::$app->site;
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
