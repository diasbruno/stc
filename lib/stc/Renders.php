<?php

namespace STC;

class Renders
{
  /**
   * Store all renderers.
   * @var array
   */
  private $renders;

  /**
   * @constructor
   */
	public function __construct()
  {
    $this->renders = array();
  }

  /**
   * Select a render by the extension of the file.
   * @param $filename string | The filename.
   * @return Render
   */
  public function select($filename)
  {
    $ext = substr(strrchr($filename, "."), 1);

    foreach ($this->renders as $renderer) {
      if ($renderer->can_use($ext)) {
        return $renderer;
      }
    }

    throw new \Exception('Render not available for this extension.');
  }

  /**
   * Register a new render.
   * @param $render object | An instance of a render.
   * @return void
   */
  public function register($render)
  {
    if ($render != null) {
      $this->renders[] = $render;
      return;
    }

    throw new \Exception('A render instance cannot be null.');
  }
}
