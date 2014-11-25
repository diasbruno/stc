<?php

namespace STC;

class Render
{
  /**
   * Store the list of extension that can be rendered by this renders.
   * @var array
   */
  protected $exts; 

  /**
   * Return true if the extension is available.
   * @param $ext string | The file extension.
   * @return bool
   */
  public function can_use($ext = '')
  {
    return in_array($ext, $this->exts);
  }
}
