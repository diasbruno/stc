# stc

A static page generator.

The main objective of stc is to make a simple and extensible static page generator.

## Dev

[![Coverage Status](https://coveralls.io/repos/diasbruno/stc/badge.png)](https://coveralls.io/r/diasbruno/stc)

### Dependencies

You will need [composer](http://getcomponser.org). That's it.

### Getting started

Create your composer file and added the STC core engine.

```
{
  ...
  "autoload": {
    "classmap": [...] // load your components...
  },
  "require": {
    "diasbruno/stc": "dev-master"
  }
}
```

In the same path as your composer.json file, creates your project file (project.php).

This should be enough to have a start project.

```
<?php

// the same directory where your composer file is located.
$current_dir = dirname(__FILE__);
require $current_dir . '/vendor/autoload.php';

use STC\Config;

// sets the directory where the data is stored.
// 'data' is a directory in the root of the project.
if (Config::bootstrap($current_dir, 'data')) {
  /* register components and renders.
   * they work this way, because, maybe, you want to extend
   * some of the plugins to your needs.
   * NOTE: STC\PageComponent and new STC\PageRender must be loaded, or their extended classes.
   * NOTE: STC\PostComponent and new STC\PostRender are plugins (stc-posts)...
   */
  Config::register_component(new STC\PageComponent);
  Config::register_render(new STC\PageRender);
  Config::register_component(new STC\PostComponent);
  Config::register_render(new STC\PostRender);
  // user category component and render classes.
  Config::register_component(new CategoryComponent);
  Config::register_render(new CategoryRender);
  // then, execute the generator.
  Config::run();
}
```

### LICENSE

Released under [the MIT license](LICENSE).
