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

GreaterThan
-----------

- ``Counterpart\Matcher\GreaterThan``
- ``Counterpart\Matchers::greaterThan($someNumber)``

Checks if a value is greater than an expected value.

.. code-block:: php

    <?php
    use Counterpart\Matcher\GreaterThan;

    $matcher = new GreaterThan(10);
    $matcher->matches(11); // true
    $matcher->matches(9); // false

HasKey
------

- ``Counterpart\Matcher\HasKey``
- ``Counterpart\Matchers::hasKey($someKey)``

Checks if an array or ``ArrayAccess`` implementation has a give key.

.. code-block:: php

    <?php
    use Counterpart\Matcher\HasKey;

    $matcher = new HasKey('aKey');
    $matcher->matches(['aKey' => true]); // true
    $matcher->matches(new \ArrayObject(['aKey' => true)); // true

HasProperty
-----------

- ``Counterpart\Matcher\HasProperty``
- ``Counterpart\Matchers::hasProperty('aPropertyName')``

Checks to see if an object has a given property, optionally disallowing non-public
properties.

.. code-block:: php

    <?php
    use Counterpart\Matcher\HasProperty;

    $allowPrivate = true; // the default
    $matcher = new HasProperty('aProp', $allowPrivate);
    $actual = new \stdClass;
    $actual->aProp = true;
    $matcher->matches($actual); // true
