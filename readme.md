# stc

[![Build Status](https://travis-ci.org/diasbruno/stc.svg?branch=master)](https://travis-ci.org/diasbruno/stc)

A static page generator.

The main objective of stc is to make a simple and extensible static page generator.

### Getting started

You will need [composer](http://getcomponser.org). That's it.

Create your composer file and added the STC core engine.

```
{
  ...
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
if (Application::bootstrap($current_dir, 'data')) {
  /* register databases and writers.
   * they work this way, because, maybe, you want to extend
   * some of the plugins to your needs.
   * NOTE: STC\PageDatabase and new STC\PageWriter must be loaded, or their extended classes.
   * NOTE: STC\PostDatabase and new STC\PostWriter are plugins (stc-posts)...
   */
  Application::register_database(new STC\PageDatabase);
  Application::register_writer(new STC\PageWriter);
  Application::register_database(new STC\PostDatabase);
  Application::register_writer(new STC\PostWriter);
  // user category database and writer classes.
  Application::register_database(new CategoryDatabase);
  Application::register_writer(new CategoryWriter);
  // then, execute the generator.
  Application::run();
}
```

### LICENSE

Released under [the MIT license](LICENSE).
