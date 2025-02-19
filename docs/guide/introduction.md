# Introduction

PHP Language Recognition Tool (phplrt) - it is a set of libraries for the
development of the so-called &laquo;frontend&raquo; programming languages.
After writing a grammar describing the syntax of your language, you get an
[abstract syntax tree](https://en.wikipedia.org/wiki/Abstract_syntax_tree).

The tool is divided into two components - a component for development, the
so-called [compiler-compiler](https://en.wikipedia.org/wiki/Compiler-compiler)
(or compiler generator) and a runtime component used for parsing after the 
development of the language itself.

For brevity, your `composer.json` file may contain lines similar to the following:

```json
{
    "require": {
        "phplrt/runtime": "^3.2"
    },
    "require-dev": {
        "phplrt/phplrt": "^3.2"
    }
}
```

However, it should be noted that, although this is a valid, but not mandatory
option. Each library can be used separately, and the components interact
directly with each other using interfaces (using &laquo;contract&raquo; 
components). For example, you might well use completely custom lexer, and use
the `phplrt` as a parser only, like this:

```json
{
    "require": {
        "phplrt/parser": "^3.2",
        "custom/lexer": "*"
    }
}
```

## Components

Now let's move on to the components themselves and a description of what they
are responsible for.

### Source

As the name implies, the component is responsible for minimal abstraction
over the source code. The minimum capabilities of the source interface is
to read data and obtain auxiliary information, such as the name of the file
from which the source was created and the identification hash of the
source code.

To install the component, use the command `composer require phplrt/source`.

### Position

The position component provides the ability to process information about the
position in the source code: offset in bytes, line and column. And also work
with intervals: Start and end positions in the source.

To install the component, use the command `composer require phplrt/position`.

### Exception

The exception component provides advanced error and error message manipulation
capabilities, allowing their internal information containing PHP data to be
delegated to an external language.

To install the component, use the command `composer require phplrt/exception`.

### Lexer

The lexer component provides the ability to group a sequence of characters
according to some criteria, forming so-called tokens (or lexemes) from the
source code.

To install the component, use the command `composer require phplrt/lexer`.

### Buffer

TODO

To install the component, use the command `composer require phplrt/buffer`.

### Parser

TODO

To install the component, use the command `composer require phplrt/parser`.

### Visitor

TODO

To install the component, use the command `composer require phplrt/visitor`.
