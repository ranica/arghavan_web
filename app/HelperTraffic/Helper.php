<?php
namespace App\HelperTraffic;


class Helper
{
    public static $items = array();

    public static function rebackItem()
    {
        return static::$items;
    }


    public static function addItem($obj, $key = null)
    {
        if ($key == null) {
            self::$items[] = $obj;
        }
        else {
            if (isset(self::$items[$key])) {
                // throw new KeyHasUseException("Key $key already in use.");
                return false;
            }
            else {
                self::$items[$key] = $obj;
                return true;
            }
        }
    }

    public static function deleteItem($key)
    {

        if (isset(self::$items[$key]))
        {
            unset(self::$items[$key]);
        }
        else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    public static function getItem($key)
    {
        if (isset(self::$items[$key]))
        {
            return self::$items[$key];
        }
        else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    public static function keys() {
        return array_keys(self::$items);
    }


    public static function keyExists($key)
    {
        return isset(self::$items[$key]);
    }

    public static function length() {
        return count(self::$items);
    }
}

