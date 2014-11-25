<?php

namespace STC\Test;

use STC\Renders;
use STC\DefaultRender;
use STC\MarkdownRender;

class DefaultRenderTest extends \PHPUnit_Framework_TestCase
{
  private $renderers;

  public function setup()
  {
    $this->renderers = new Renders();
    $this->renderers->register(new DefaultRender());
    $this->renderers->register(new MarkdownRender());
  }

  public function testRunDefaultRender()
  {
    $template = __DIR__.'/data/templates/test.phtml';

    $renderer = $this->renderers->select('test.phtml');
    
    $view = $renderer->render($template, array('ok' => 'OK'));
    $this->assertTrue($view == '<p>OK</p>
');
  }

  public function testRunMarkdownRender()
  {
    $template = __DIR__.'/data/templates/test.md';

    $renderer = $this->renderers->select('test.md');

    $view = $renderer->render($template, array('ok' => 'OK'));
    $this->assertTrue($view == '<p>OK</p>');
  }
}
