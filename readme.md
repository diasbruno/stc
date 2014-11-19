# stc

A static page generator.

The main objective of stc is to make a simple and extensible static page generator.

## Dependencies

You will need [composer](http://getcomponser.org). That's it.

## Getting started

Create your composer file and added the stc core engine.

```
{
  ...
  "autoload": {
    "classmap": [...] // load your components...
  },
  "require": {
    // core engine.
    "diasbruno/stc-utils": "dev-master",
    "diasbruno/stc": "dev-master"
  }
}
```

## LICENSE

Released under [the MIT license](LICENSE).
