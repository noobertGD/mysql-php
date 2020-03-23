<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/03/2020
 * Time: 09:17
 */
//functions:
/**
 * returns the size of the longest string in the list
 * @param $list
 * @return int
 */
function findLongestStringSize($list)
{
    $longestRecord = 0;
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


const DATABASE_FILE = __DIR__ . '/databases';
$check = true;
$currentDatabaseName = "";
$rec = false;
$databases = [];
$tables = [];
$record = 0;
$repeat = false;
if (file_exists(__DIR__ . "/tables")) {
    $tabt = file_get_contents("tables");
    $tables = unserialize($tabt);
}
if (file_exists(DATABASE_FILE)) {

    $tabt = file_get_contents(DATABASE_FILE);

    $databases = unserialize($tabt);


}


while (true) {

    $command = readline("mysql>");


    if ($command == "show tables") {
        echo "+";
        //get the biggest word:
        $maxLength = findLongestStringSize($databases[$currentDatabaseName]);

        for ($i2 = 0; $i2 < $maxLength; $i2++) {
            echo "-";
        }

        echo "+" . PHP_EOL;


        $i = 0;
        foreach ($databases[$currentDatabaseName] as $i => $value) {
            echo "|";

            echo $databases[$currentDatabaseName][$i];

            if (strlen($databases[$currentDatabaseName][$i]) < $maxLength) {
                for ($i4 = 0; $i4 < $maxLength - strlen($databases[$currentDatabaseName][$i]); $i4++) {
                    echo " ";
                }
            }


            echo "|" . PHP_EOL;


        }
        echo "+";

        for ($i2 = 0; $i2 < $maxLength; $i2++) {
            echo "-";
        }

        echo "+" . PHP_EOL;


    } elseif (substr($command, 0, 13) === "create table ") {
        $name = substr($command, 13);

        if (!hasValue($name, $databases[$currentDatabaseName])) {

            $databases[$currentDatabaseName][] = $name;


            echo "table " . $name . " created!" . PHP_EOL;
            $tab = serialize($databases);
            file_put_contents(DATABASE_FILE, $tab);

        } else {
            echo "name can't be the same" . PHP_EOL;
        }


    } elseif (substr($command, 0, 11) === "DROP TABLE ") {
        $name = substr($command, 11);
        if ($name == "") {
            echo "DROP TABLE <TABLE NAME>" . PHP_EOL;
        }

        foreach ($databases[$currentDatabaseName] as $index => $value) {

            if ($databases[$currentDatabaseName][$index] == $name) {

                unset($databases[$currentDatabaseName][$index]);

                $tab = serialize($databases);
                file_put_contents(DATABASE_FILE, $tab);
                echo "droped table " . $name . PHP_EOL;
                break;
            }
        }
    } elseif (substr($command, 0, 16) === "create database ") {

        $databaseName = substr($command, 16);
        if ($databaseName == "") {
            echo "create database " . "<name>" . PHP_EOL;
            echo "Please enter VALID NAME" . PHP_EOL;

        } elseif (!hasValue($databaseName, array_keys($databases))) {


            $databases[$databaseName] = [];
            echo "database " . $databaseName . " created!" . PHP_EOL;
            $tab = serialize($databases);
            file_put_contents(DATABASE_FILE, $tab);


        } else {
            echo "nope!" . PHP_EOL;
        }

    } elseif ($command == "show databases") {

        echo "+";
        $record = findLongestStringSize(array_keys($databases));

        for ($i2 = 0; $i2 < $record; $i2++) {
            echo "-";
        }

        echo "+" . PHP_EOL;

        echo "|";
        $i = 0;
        foreach ($databases as $index => $value) {

            echo $index;

            if (strlen($index) < $record) {
                for ($i4 = 0; $i4 < ($record - strlen($index)); $i4++) {
                    echo " ";
                }
            }


            echo "|" . PHP_EOL;

            $i++;
            if ($i < count($databases)) {

                echo "|";
            } else {


                echo "+";


                for ($i2 = 0; $i2 < $record; $i2++) {
                    echo "-";
                }
                echo "+" . PHP_EOL;
            }

        }
    } elseif (substr($command, 0, 14) === "drop database ") {

        $databaseName = substr($command, 14);

        foreach ($databases as $index => $value) {
            if ($index == $databaseName) {

                unset($databases[$index]);
                $tab = serialize($databases);
                file_put_contents(DATABASE_FILE, $tab);
                echo "droped table " . $databaseName . PHP_EOL;
                break;
            }
        }
    } elseif (substr($command, 0, 4) === "use ") {
        $name = substr($command, 4);

        if ($name == "") {
            echo "enter valid name!" . PHP_EOL;
            $check = false;

        } else {
            $isFound = false;

            foreach ($databases as $index => $value) {

                if ($name == $index) {
                    $currentDatabaseName = $name;
                    $isFound = true;
                    break;
                }
            }

            if (!$isFound) {
                echo "name does not exist " . PHP_EOL;
            }

        }


    }


}



