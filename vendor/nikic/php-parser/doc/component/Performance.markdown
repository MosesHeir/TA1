Performance
===========

Parsing is computationally expensive task, to which the PHP language is not very well suited.
Nonetheless, there are a few things you can do to improve the performance of this library, which are
described in the following.

Xdebug
------

Running PHP with Xdebug adds a lot of overhead, especially for code that performs many method calls.
Just by loading Xdebug (without enabling profiling or other more intrusive Xdebug features), you
can expect that code using PHP-Parser will be approximately *five times slower*.

As such, you should make sure that Xdebug is not loaded when using this library. Note that setting
the `xdebug.default_enable=0` ini option does *not* disable Xdebug. The *only* way to disable
Xdebug is to not load the extension in the first place.

If you are building a command-line utility for use by developers (who often have Xdebug enabled),
you may want to consider automatically restarting PHP with Xdebug unloaded. The
[composer/xdebug-handler](https://github.com/composer/xdebug-handler) package can be used to do
this.

If you do run with Xdebug, you may need to increase the `xdebug.max_nesting_level` option to a
higher level, such as 3000. While the parser itself is recursion free, most other code working on
the AST uses recursion and will generate an error if the value of this option is too low.

Assertions
----------

Assertions should be disabled in a production context by setting `zend.assertions=-1` (or
`zend.assertions=0` if set at runtime). The library currently doesn't make heavy use of assertions,
but they are used in an increasing number of places.

Object reuse
------------

Many objects in this project are designed for reuse. For example, one `Parser` object can be used to
parse multiple files.

When possible, objects should be reused rather than being newly instantiated for every use. Some
objects have expensive initialization procedures, which will be unnecessarily repeated if the object
is not reused. (Currently two objects with particularly expensive setup are parsers and pretty
printers, though the details might change between versions of this library.)
