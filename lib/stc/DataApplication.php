<?php

namespace STC;

/**
 * @author Bruno Dias <dias.h.bruno@gmail.com>
 * @license MIT License (see LICENSE)
 */
class DataApplication
{
  /**
   * Instance that holds the main configuration.
   * @var Site
   */
  public $config = null;
  /**
   * Instance that holds where the templates are stored.
   * @var Templates
   */
  public $templates = null;
  /**
   * Instance that holds where the posts and pages are stored.
   * @var Files
   */
  public $files = null;
  /**
   * Store all data that was created by the components.
   * @var object
   */
  public $db = null;
  /**
   * Store all renders.
   * @var object
   */
  public $renders = null;

  /**
   * @constructor
   */
  public function __construct($data_folder = '')
  {
    // load the config file.
    $this->config = new Config();
    $this->config->load($data_folder);

    // load the templates.
    $this->templates = new Templates();
    $this->templates->load($data_folder);

    // loading data files.
    $this->files = new Files();
    $this->files->load($data_folder, $this->config->get('pages_data'));

    // initialize database.
    $this->db = new Database();

    // 
    $this->renders = new Renders();
  }
}
