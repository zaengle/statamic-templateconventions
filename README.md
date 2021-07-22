# Statamic Template Conventions
This package provides templating conventions for differentiating between partials, components, and fields.

## Requirements
- PHP 7.3+
- Statamic v3

## Installation
You can install this package via composer using:

`composer require zaengle/statamic-templateconventions`

The package will automatically register itself.

## Usage
Each tag accepts a wildcard path to the given template. Any number of params may be passed as part of the tag.

```
// Component Tag will look in views/components/...
{{ component:{path/to/component} }}

// Field Tag will look in views/fields/...
{{ field:{path/to/field} }}
```
