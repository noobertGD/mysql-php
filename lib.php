<?php
//functions:
/**
 * returns the size of the longest string in the list
 * @param $list
 * @return int
 */
function findLongestStringSize($list)
{
    $longestRecord = "";
    foreach ($list as $index => $value) {
        if (strlen($value) > $longestRecord) {
            $longestRecord = strlen($value);
        }
    }
    return $longestRecord;
}

/**
 * check if value exists inside the list
 * @param $value
 * @param $list
 * @return bool
 */
function hasValue($value, $list)
{
    foreach ($list as $index => $listValue) {
        if ($value === $listValue) {
            return true;
        }
    }
    return false;
}
