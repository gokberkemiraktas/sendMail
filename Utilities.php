<?php

use JetBrains\PhpStorm\NoReturn;
use Services\LogService;

class Utilities
{
    public static function getPostData(): array
    {
        $postData = file_get_contents('php://input');
        return json_decode($postData, true);
    }

    public static function validate(array $data, array $validationData): bool
    {
        foreach ($validationData as $key => $value) {
            if ($value == "required") {
                if (empty($data[$key])) {
                    LogService::add("Validation error: " . $key . " is required");
                    return false;
                }
            }
        }
        return true;
    }

    #[NoReturn] public static function return(mixed ...$data): void
    {
        $items = [];
        foreach ($data as $item) {
            if (is_array($item) || is_object($item)) {
                $items[] = json_encode($item);
            } elseif (is_bool($item)) {
                $items[] = $item ? "true" : "false";
            } elseif (is_null($item)) {
                $items[] = "null";
            } elseif (is_string($item)) {
                $items[] = '"' . $item . '"';
            }
        }
        die(implode(", ", $items));


//        if (is_array($data) || is_object($data)) {
//            $data = json_encode($data);
//        } elseif (is_bool($data)) {
//            $data = $data ? "true" : "false";
//        } elseif (is_null($data)) {
//            $data = "null";
//        } elseif (is_string($data)) {
//            $data = '"' . $data . '"';
//        }
//        die($data);
    }
}

