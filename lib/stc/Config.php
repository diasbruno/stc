<?php

namespace STC;

/**
 * @author Bruno Dias <dias.h.bruno@gmail.com>
 * @license MIT License (see LICENSE)
 */
class Config
{
  /**
   * Stores the loaded config file.
   * @var array
   */
  private $data;
  /**
   * Validates the loaded config file.
   * @var DataValidator
   */
  private $validator;

  /**
   * @constructor
   */
  public function __construct()
  {
    $this->data = array();
    $this->validator = new DataValidator();
    $this->validator->required('name');
    $this->validator->required('pages_data');
    $this->validator->required('public_folder');
  }

  /**
   * Load files from a given directory.
   * @param $data_folder string | The folder name.
   * @return array
   */
  public function load($data_folder = '')
  {
    $loader = new DataLoader();
    $this->data = $loader->load($data_folder, '/config.json');
    if ($this->validator->validate($this->data)) {
      printLn('Config.json is ok.');
    } else {
      throw new \Exception('Config.json fail.');
    }
  }

  /**
   * Returns the name of the project.
   * @return string
   */
  public function name()
  {
    return $this->data['name'];
  }

  /**
   * Returns the name of the public folder
   * where all the files will be exported.
   * @return string
   */
  public function public_folder()
  {
    return $this->data['public_folder'];
  }

  /**
   * Use this method to ensure that the key must be present.
   * @param $key string | The key name.
   * @return object
   */
  public function get($key)
  {
    return $this->data[$key];
  }

  /**
   * Use this method for optional values.
   * @param $key string | The key name.
   * @return object
   */
  public function getOptional($key, $defaultValue = null)
  {
    if (array_key_exists($key, $this->data)) {
      return $this->data[$key];
    }
    return $defaultValue;
  }
}
