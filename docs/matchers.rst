Matchers
========

This document describe what the varous matchers in Counterpart do. Other documents
describe how to :doc:`create matchers <custom-matchers>`.

Anything
--------

- ``Counterpart\Matcher\Anything``
- ``Counterpart\Matchers::anything()``

Literally matches anything.

Callback
--------

- ``Counterpart\Matcher\Callback``
- ``Counterpart\Matchers::callback('some_callable')``

Runs a value through a user defined callback.

.. code-block:: php

    <?php
    use Counterpart\Matcher\Callback;

    $matcher = new Callback(function ($actual) {
        return true; // just like `Anything`
    });

Contains
--------

- ``Counterpart\Matcher\Contains``
- ``Counterpart\Matchers::contains($someValue)``

Checks to see whether an array or ``Traversable`` contains a value (optionally
using strict comparison).

.. code-block:: php

    <?php
    use Counterpart\Matcher\Contains;

    $strict = true;
    $matcher = new Contains('one', $strict);
    $matcher->matches(['one', 'two']); // true

Count
-----

- ``Counterpart\Matcher\Count``
- ``Counterpart\Matchers::count($someCount)``

Checks to see if an array, ``Traversable``, or ``Countable`` equals an expected
value.

.. code-block:: php

    <?php
    use Counterpart\Matcher\Count;

    $matcher = new Count(1);
    $matcher->matches(['one']); // true

FileExists
----------

- ``Counterpart\Matcher\FileExists``
- ``Counterpart\Matchers::fileExists($someFilePath)``

Checks to see of a file path exists.

.. code-block:: php

    <?php
    use Counterpart\Matcher\FileExists;

    $matcher = new FileExists();
    $matcher->matches(__FILE__);
