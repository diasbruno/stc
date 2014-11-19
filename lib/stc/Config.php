<?php

namespace STC;

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
   * Instance that holds the main configuration.
   * @var Site
   */
  static private $site = null;
  /**
   * Instance that holds where the templates are stored.
   * @var Templates
   */
  static private $templates = null;
  /**
   * Instance that holds where the posts and pages are stored.
   * @var Files
   */
  static private $files = null;
  /**
   * Store all data that was created by the components.
   * @var object
   */
  static private $db = [];

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
    self::$site = new Site();
    self::$site->load(self::$data_folder);

    // load the templates.
    self::$templates = new Templates();
    self::$templates->load(self::$data_folder);

    // loading data files.
    self::$files = new Files();
    self::$files->load(self::$data_folder);

    // initialize database.
    self::$db = new Database();

    // boot app.
    self::register_component(new PageComponent);
    self::register_render(new PageRender);
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
  static public function data_folder() { return self::$data_folder; }

  /**
   * Returns the site instance.
   * @return Site
   */
  static public function site() { return self::$site; }

  /**
   * Returns the templates instance.
   * @return Templates
   */
  static public function templates() { return self::$templates; }

  /**
   * Returns the files instance.
   * @return Files
   */
  static public function files() { return self::$files; }

  /**
   * Returns the database instance.
   * @return Files
   */
  static public function db() { return self::$db; }
}
