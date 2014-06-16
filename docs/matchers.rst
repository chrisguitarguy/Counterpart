Matchers
========

This document is a brief overview of all the matchers that counter part provides.
For a more in depth look at the matchers, head over to the
`api documentation <http://api.counterpartphp.org>`_.

For information about custom matchers see :doc:`custom-matchers`.

Built in Matchers
-----------------

- ``Anything``: Match literally anything.
- ``Callback``: Run the actual value through a user defined callback. If the
  callback returns a truthy value it's a match.
- ``Contains``: Check if an array of ``Traversable`` contains a value
- ``Count``: Check if an array, ``Traversable``, or ``Countable`` matches an
  expected count.
- ``FileExists``: Check if a file exists.
- ``GreaterThan``: Check if a value is greater than an expected number.
- ``HasKey``: Check if an array or ``ArrayAccess`` contains a given key.
- ``HasProperty``: Check if an object has a given property. This can be configured
  to only match public properties.
- ``IsEmpty``: Check if a value is empty (eg. ``empty($actual)``).
- ``IsEqual``: Check if two values are equal -- can be configured to use strict
  equality.
- ``IsFalse``: Check if an actual value is exactly equal to ``false``.
- ``IsFalsy``: Check if an actual value is *falsy*. These are things like ``"no"``,
  ``0``, or ``"0"``.
- ``IsInstanceOf``: Check of an actual value is an instance of a given class or
  interfact.
- ``IsJson``: Check if an actual value is a valid `JSON <http://www.json.org/>`
  string.
- ``IsNull``: Check if an actual value is exactly equal to ``null``.
- ``IsTrue``: Check if an actual value is exactly equal to ``true``.
- ``IsTruthy``: Check if an actual value is *truthy*. These are things like
  ``"yes"``, ``1``, or ``"1"``.
- ``IsType``: Check if an object is an internal type.
- ``LessThan``: Check if an actual value is less than a given number.
- ``LogicalAnd``: Combine one or more matchers with a conjuction. See
  :doc:`logical-combinations`. Will match if all sub-matchers match.
- ``LogicalNot``: Negate a matcher. See :doc:`logical-combinations`.
- ``LogicalOr``: Combine one or more matchers with a disjunction. See
  :doc:`logical-combinations`. Will match if an only if one of its sub-matchers
  matches.
- ``LogicalXor``: Combine one or more matchers with an XOR. ``LogicalXor`` will
  match if an only if exactly one of its sub-matchers matches.
- ``MatchesRegex``: Checks a string (or object with a ``__toString`` method)
  against a regular expression.
- ``PhptFormat``: Checks a string against a `phpt format <http://qa.php.net/phpt_details.php#expectf_section>`.
- ``StringContains``: Checks to see if a string contains an expected value.
