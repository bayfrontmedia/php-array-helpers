<?php
/**
 * @package php-array-helpers
 * @link https://github.com/bayfrontmedia/php-array-helpers
 * @author John Robinson <john@bayfrontmedia.com>
 * @copyright 2020-2021 Bayfront Media
 */

namespace Bayfront\ArrayHelpers;

class Arr
{

    /**
     * Converts a multidimensional array to a single depth "dot" notation array,
     * optionally prepending a string to each array key.
     *
     * The key values will never be an array, even if empty. Empty arrays will be dropped.
     *
     * See also: https://stackoverflow.com/a/10424516
     *
     * @param array $array (Original array)
     * @param string $prepend (String to prepend)
     *
     * @return array
     */

    public static function dot(array $array, string $prepend = ''): array
    {

        $results = [];

        foreach ($array as $key => $value) {

            if (is_array($value)) {

                $results = array_merge($results, self::dot($value, $prepend . $key . '.'));

            } else {

                $results[$prepend . $key] = $value;

            }

            // Empty arrays are not returned

        }

        return $results;

    }

    /**
     * Converts array in "dot" notation to a standard multidimensional array.
     *
     * @param array $array (Array in "dot" notation)
     *
     * @return array
     */

    public static function undot(array $array): array
    {

        $return = [];

        foreach ($array as $key => $value) {

            self::set($return, $key, $value);

        }

        return $return;

    }

    /**
     * Set an array item to a given value using "dot" notation.
     *
     * @param array $array (Original array)
     * @param string $key (Key to set in "dot" notation)
     * @param mixed $value (Value of key)
     *
     * @return void
     */

    public static function set(array &$array, string $key, $value): void
    {

        $keys = explode('.', $key);

        while (count($keys) > 1) {

            $key = array_shift($keys);

            /*
             * If the key doesn't exist at this depth, an empty array is created
             * to hold the next value, allowing to create the arrays to hold final
             * values at the correct depth. Then, keep digging into the array.
             */

            if (!isset($array[$key]) || !is_array($array[$key])) {

                $array[$key] = [];

            }

            $array = &$array[$key];

        }

        $array[array_shift($keys)] = $value;

    }

    /**
     * Checks if array key exists and not null using "dot" notation.
     *
     * @param array $array (Original array)
     * @param string $key (Key to check in "dot" notation)
     *
     * @return bool
     */

    public static function has(array $array, string $key): bool
    {
        return NULL !== self::get($array, $key);
    }

    /**
     * Get an item from an array using "dot" notation, returning an optional default value if not found.
     *
     * @param array $array (Original array)
     * @param string $key (Key to return in "dot" notation)
     * @param mixed $default (Default value to return)
     *
     * @return mixed
     */

    public static function get(array $array, string $key, $default = NULL)
    {

        if (is_null($key)) {

            return $array;

        }

        if (isset($array[$key])) {

            return $array[$key];

        }

        foreach (explode('.', $key) as $segment) {

            if (!is_array($array) || !array_key_exists($segment, $array)) {

                return $default;

            }

            $array = $array[$segment];

        }

        return $array;

    }

    /**
     * Returns an array of values for a given key from an array using "dot" notation.
     *
     * @param array $array (Original array)
     * @param string $value (Value to return in "dot" notation)
     * @param string|null $key (Optionally how to key the returned array in "dot" notation)
     *
     * @return array
     */

    public static function pluck(array $array, string $value, string $key = NULL): array
    {
        $results = [];

        foreach ($array as $item) {

            $itemValue = self::get($item, $value);

            if (is_null($key)) {

                $results[] = $itemValue;

            } else {

                $itemKey = self::get($item, $key);

                $results[$itemKey] = $itemValue;

            }

        }

        return $results;
    }

    /**
     * Remove a single key, or an array of keys from a given array using "dot" notation.
     *
     * @param array $array (Original array)
     * @param string|array $keys (Key(s) to forget in "dot" notation)
     *
     * @return void
     */

    public static function forget(array &$array, $keys): void
    {

        $original =& $array;

        foreach ((array)$keys as $key) {

            $parts = explode('.', $key);

            while (count($parts) > 1) {

                $part = array_shift($parts);

                if (isset($array[$part]) && is_array($array[$part])) {

                    $array =& $array[$part];

                }

            }

            unset($array[array_shift($parts)]);

            // Clean up after each iteration

            $array =& $original;

        }
    }

    /**
     * Returns the original array except given key(s).
     *
     * @param array $array (Original array)
     * @param string|array $keys (Keys to remove)
     *
     * @return array
     */

    public static function except(array $array, $keys): array
    {
        return array_diff_key($array, array_flip((array)$keys));
    }

    /**
     * Returns only desired key(s) from an array.
     *
     * @param array $array (Original array)
     * @param string|array $keys (Keys to return)
     *
     * @return array
     */

    public static function only(array $array, $keys): array
    {
        return array_intersect_key($array, array_flip((array)$keys));
    }

    /**
     * Returns array of missing keys from the original array, or an empty array if none are missing.
     *
     * @param array $array (Original array)
     * @param string|array $keys (Keys to check)
     *
     * @return array
     */

    public static function missing(array $array, $keys): array
    {
        return array_values(array_flip(array_diff_key(array_flip((array)$keys), $array)));
    }

    /**
     * Checks if keys are missing from the original array
     *
     * @param array $array (Original array)
     * @param string|array $keys (Keys to check)
     *
     * @return bool
     */

    public static function isMissing(array $array, $keys): bool
    {
        return (self::missing($array, $keys)) ? true : false;
    }

    /**
     * Sort a multidimensional array by a given key in ascending (optionally, descending) order.
     *
     * @param array $array (Original array)
     * @param string $key (Key name to sort by)
     * @param bool $descending (Sort descending)
     *
     * @return array
     */

    public static function multisort(array $array, string $key, bool $descending = false): array
    {

        $columns = array_column($array, $key);

        if (false === $descending) {

            array_multisort($columns, SORT_ASC, $array, SORT_NUMERIC);

        } else {

            array_multisort($columns, SORT_DESC, $array, SORT_NUMERIC);

        }

        return $array;

    }

    /**
     * Rename array keys while preserving their order.
     *
     * @param array $array (Original array)
     * @param array $keys (Key/value pairs to rename)
     *
     * @return array
     */

    public static function renameKeys(array $array, array $keys): array
    {

        $new_array = [];

        foreach ($array as $k => $v) {

            if (array_key_exists($k, $keys)) {

                $new_array[$keys[$k]] = $v;

            } else {

                $new_array[$k] = $v;

            }

        }

        return $new_array;

    }

    /**
     * Order an array based on an array of keys.
     *
     * Keys from the $order array which do not exist in the original array will be ignored.
     *
     * @param array $array (Original array)
     * @param array $order (Array of keys in the order to be returned)
     *
     * @return array
     */

    public static function order(array $array, array $order): array
    {
        return self::only(array_replace(array_flip($order), $array), array_keys($array));
    }

    /**
     * Convert array into a query string.
     *
     * @param array $array (Original array)
     *
     * @return string
     */

    public static function query(array $array): string
    {
        return http_build_query($array, NULL, '&', PHP_QUERY_RFC3986);
    }

    /**
     * Return an array of values which exist in a given array.
     *
     * @param array $array
     * @param array $values
     *
     * @return array
     */

    public static function getAnyValues(array $array, array $values): array
    {
        return array_intersect($values, Arr::dot($array));
    }

    /**
     * Do any values exist in a given array.
     *
     * @param array $array
     * @param array $values
     *
     * @return bool
     */

    public static function hasAnyValues(array $array, array $values): bool
    {
        return !empty(self::getAnyValues($array, $values));
    }

    /**
     * Do all values exist in a given array.
     *
     * @param array $array
     * @param array $values
     *
     * @return bool
     */

    public static function hasAllValues(array $array, array $values): bool
    {
        return count(array_intersect($values, Arr::dot($array))) == count($values);
    }

}