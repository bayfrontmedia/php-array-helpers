## PHP array helpers

PHP helper class to provide useful array functions.

- [License](#license)
- [Author](#author)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

<img src="https://cdn1.onbayfront.com/bfm/brand/bfm-logo.svg" alt="Bayfront Media" width="250" />

- [Bayfront Media homepage](https://www.bayfrontmedia.com?utm_source=github&amp;utm_medium=direct)
- [Bayfront Media GitHub](https://github.com/bayfrontmedia)

## Requirements

* PHP `^8.0` (Tested up to `8.4`)

## Installation

```
composer require bayfrontmedia/php-array-helpers
```

## Usage

- [dot](#dot)
- [undot](#undot)
- [set](#set)
- [has](#has)
- [get](#get)
- [pluck](#pluck)
- [forget](#forget)
- [except](#except)
- [exceptValues](#exceptvalues)
- [only](#only)
- [missing](#missing)
- [isMissing](#ismissing)
- [multisort](#multisort)
- [numericMultisort](#numericmultisort)
- [renameKeys](#renamekeys)
- [order](#order)
- [getRandomItems](#getrandomitems)
- [query](#query)
- [getAnyValues](#getanyvalues)
- [hasAnyValues](#hasanyvalues)
- [hasAllValues](#hasallvalues)
- [ensureHas](#ensurehas)

<hr />

### dot

**Description:**

Converts a multidimensional array to a single depth "dot" notation array, optionally prepending a string to each array key.

The key values will never be an array, even if empty. Empty arrays will be dropped.

**Parameters:**

- `$array` (array): Original array
- `$prepend = ''` (string): String to prepend

**Returns:**

- (array)

**Example:**

```
$array = [
    'name' => [
        'first_name' => 'John',
        'last_name' => 'Doe'
    ],
    'hobbies' => [ // This empty array will be dropped

    ]
];

$dot = Arr::dot($array);
```

<hr />

### undot

**Description:**

Converts array in "dot" notation to a standard multidimensional array.

**Parameters:**

- `$array` (array): Array in "dot" notation

**Returns:**

- (array)

**Example:**

```
$array = [
    'name.first_name' => 'John',
    'name.last_name' => 'Doe'
];

$undot = Arr::undot($array);
```

<hr />

### set

**Description:**

Set an array item to a given value using "dot" notation.

**Parameters:**

- `$array` (array): Original array
- `$key` (string): Key to set in "dot" notation
- `$value` (mixed): Value of key

**Returns:**

- (void)

**Example:**

```
$array = [
    'name' => [
        'first_name' => 'John',
        'last_name' => 'Doe'
    ],
];

Arr::set($array, 'name.middle_name', 'Middle');
```

<hr />

### has

**Description:**

Checks if array key exists and not null using "dot" notation.

**Parameters:**

- `$array` (array): Original array
- `$key` (string): Key to check in "dot" notation

**Returns:**

- (bool)

**Example:**

```
$array = [
    'name' => [
        'first_name' => 'John',
        'last_name' => 'Doe'
    ],
];

if (Arr::has($array, 'name.first_name')) {
    // Do something
}
```

<hr />

### get

**Description:**

Get an item from an array using "dot" notation, returning an optional default value if not found.

**Parameters:**

- `$array` (array): Original array
- `$key` (string): Key to return in "dot" notation
- `$default = NULL` (mixed): Default value to return

**Returns:**

- (mixed)

**Example:**

```
$array = [
    'name' => [
        'first_name' => 'John',
        'last_name' => 'Doe'
    ],
];

echo Arr::get($array, 'name.first_name');
```

<hr />

### pluck

**Description:**

Returns an array of values for a given key from an array using "dot" notation.

**Parameters:**

- `$array` (array): Original array
- `$value` (string): Value to return in "dot" notation
- `$key = NULL` (string|null): Optionally how to key the returned array in "dot" notation

**Returns:**

- (array)

**Example:**

```
$array = [
    [
        'user_id' => 110,
        'username' => 'John',
        'active' => true
    ],
    [
        'user_id' => 111,
        'username' => 'Jane',
        'active' => true
    ]
];

$array = Arr::pluck($array, 'username', 'user_id');
```

<hr />

### forget

**Description:**

Remove a single key, or an array of keys from a given array using "dot" notation.

**Parameters:**

- `$array` (array): Original array
- `$keys` (string|array): Key(s) to forget in "dot" notation

**Returns:**

- (void)

**Example:**

```
$array = [
    'name' => [
        'first_name' => 'John',
        'last_name' => 'Doe'
    ],
];

Arr::forget($array, 'name.last_name');
```

<hr />

### except

**Description:**

Returns the original array except given key(s).

**Parameters:**

- `$array` (array): Original array
- `$keys` (string|array): Key(s) to remove

**Returns:**

- (array)

**Example:**

```
$array = [
    'user_id' => 110,
    'username' => 'John',
    'active' => true
];

$array = Arr::except($array, 'active');
```

<hr />

### exceptValues

**Description:**

Returns the original array except given value(s).

**Parameters:**

- `$array` (array): Original array
- `$values` (string|array): Values(s) to remove

**Returns:**

- (array)

**Example:**

```
$array = [
    'John',
    'Jane',
    'Bob'
];

$array = Arr::exceptValues($array, 'John');
```

<hr />

### only

**Description:**

Returns only desired key(s) from an array.

**Parameters:**

- `$array` (array): Original array
- `$keys` (string|array): Key(s) to return

**Returns:**

- (array)

**Example:**

```
$array = [
    'user_id' => 110,
    'username' => 'John',
    'active' => true
];

$array = Arr::only($array, 'username');
```

<hr />

### missing

**Description:**

Returns array of missing keys from the original array, or an empty array if none are missing.

**Parameters:**

- `$array` (array): Original array
- `$keys` (array): Key(s) to check

**Returns:**

- (array)

**Example:**

```
$array = [
    'user_id' => 110,
    'username' => 'John',
    'active' => true
];

$missing = Arr::missing($array, [
    'active',
    'last_login'
]);
```

<hr />

### isMissing

**Description:**

Checks if keys are missing from the original array.

**Parameters:**

- `$array` (array): Original array
- `$keys` (array): Key(s) to check

**Returns:**

- (bool)

**Example:**

```
$array = [
    'user_id' => 110,
    'username' => 'John',
    'active' => true
];

if (Arr::isMissing($array, [
    'active',
    'last_login'
])) {
    // Do something
}
```

<hr />

### multisort

**Description:**

Sort a multidimensional array by a given key in ascending (optionally, descending) order.

**Parameters:**

- `$array` (array): Original array
- `$key` (string): Key name to sort by
- `$descending = false` (bool): Sort descending

**Returns:**

- (array)

**Example:**

```
$clients = [
    [
        'first_name' => 'John',
        'last_name' => 'Doe'
    ],
    [
        'first_name' => 'Jane',
        'last_name' => 'Doe'
    ]
];

$sorted = Arr::multisort($clients, 'first_name');
```

<hr />

### numericMultisort

**Description:**

Sort a numerically indexed array of multidimensional arrays by a given key in ascending (optionally, descending) order.

**Parameters:**

- `$array` (array): Numerically indexed array of multidimensional arrays
- `$key` (string): Key name to sort by in dot notation
- `$descending = false` (bool): Sort descending

**Returns:**

- (array)

**Example:**

```
$contacts = [
    [
        'id' => 1,
        'contact' => [
            'name' => 'James'
        ]
    ],
    [
        'id' => 2,
        'contact' => [
            'name' => 'Bob'
        ]
    ],
    [
        'id' => 3,
        'contact' => [
            'name' => 'Carl'
        ]
    ]
];

$sorted = Arr::numericMultisort($contacts, 'contact.name');
```

<hr />

### renameKeys

**Description:**

Rename array keys while preserving their order.

**Parameters:**

- `$array` (array): Original array
- `$keys` (array): Key/value pairs to rename

**Returns:**

- (array)

**Example:**

```
$user = [
    'UserID' => 5,
    'UserEmail' => 'name@example.com',
    'UserGroup' => 'Administrator'
];

$renamed = Arr::renameKeys($user, [
    'UserID' => 'id',
    'UserEmail' => 'email',
    'UserGroup' => 'group'
]);
```

<hr />

### order

**Description:**

Order an array based on an array of keys.

Keys from the `$order` array which do not exist in the original array will be ignored.

**Parameters:**

- `$array` (array): Original array
- `$order` (array): Array of keys in the order to be returned

**Returns:**

- (array)

**Example:**

```
$address = [
    'street' => '123 Main St.',
    'state' => 'IL',
    'zip' => '60007',
    'city' => 'Chicago'
];

$order = [
    'street',
    'city',
    'state',
    'zip',
    'country'
];

$address = Arr::order($address, $order);
```

The above example will return the following array:

```
Array
(
    [street] => 123 Main St.
    [city] => Chicago
    [state] => IL
    [zip] => 60007
)
```

<hr />

### getRandomItems

**Description:**

Get random items from array.

If `$count` is greater than or equal to the number of items on the array,
the original array is returned in random order.

**Parameters:**

- `$array` (array): Original array
- `$count` (int): Number of random items to return

**Returns:**

- (array)

**Example:**

```
$array = [
    'John',
    'Jane',
    'Bob'
];

$array = Arr::getRandomItems($array, 1);
```

<hr />

### query

**Description:**

Convert array into a query string.

**Parameters:**

- `$array` (array): Original array

**Returns:**

- (string)

**Example:**

```
$array = [
    'first_name' => 'Jane',
    'last_name' => 'Doe'
];

echo Arr::query($array);
```

<hr />

### getAnyValues

**Description:**

Return an array of values which exist in a given array.

**Parameters:**

- `$array` (array)
- `$values` (array)

**Returns:**

- (array)

**Example:**

```
$array = [
    'name' => [
        'John',
        'Dave'
    ],
];

$existing_values = Arr::getAnyValues($array['name'], [
    'John',
    'Jane'
]);
```

<hr />

### hasAnyValues

**Description:**

Do any values exist in a given array.

**Parameters:**

- `$array` (array)
- `$values` (array)

**Returns:**

- (bool)

**Example:**

```
$array = [
    'name' => [
        'John',
        'Dave'
    ],
];

if (Arr::hasAnyValues($array['name'], [
    'John',
    'Jane'
])) { 
     // Do something
}
```

<hr />

### hasAllValues

**Description:**

Do all values exist in a given array.

**Parameters:**

- `$array` (array)
- `$values` (array)

**Returns:**

- (bool)

**Example:**

```
$array = [
    'name' => [
        'John',
        'Dave'
    ],
];

if (Arr::hasAllValues($array['name'], [
    'John',
    'Jane'
])) { 
     // Do something
}
```

<hr />

### ensureHas

**Description:**

Ensure a numerically indexed array of arrays has a given item based on a unique key.

**Parameters:**

- `$array` (array)
- `$item` (array): Item to exist
- `$unique_key` (string): Unique array key

**Returns:**

- (bool)

**Example:**

```
$contacts = [
    [
        'id' => 1,
        'contact' => [
            'name' => 'James'
        ]
    ],
    [
        'id' => 2,
        'contact' => [
            'name' => 'Bob'
        ]
    ],
    [
        'id' => 3,
        'contact' => [
            'name' => 'Carl'
        ]
    ]
];

$item = [
    'id' => 2,
    'contact' => [
        'name' => 'Bob'
    ]
];

$contacts = Arr::ensureHas($contacts, $item, 'id');
```