<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23/03/2020
 * Time: 20:08
 */
require_once "lib.php";


//showTable(['aaa', 'xx', 'alexandru']);

function showTable($array)
{
    echo "+";
    $longestRecord = findLongestStringSize(['aaa', 'xx', 'alexandru']);

    for ($i = 0; $i < ($longestRecord + 2); $i++) {
        echo "-";

    }
    echo "+" . PHP_EOL;


    foreach ($array as $index => $value1) {
        echo "| ";
        echo $value1;
        if (strlen($value1) < $longestRecord) {
            for ($i4 = 0; $i4 < $longestRecord - strlen($value1); $i4++) {
                echo " ";
            }
        }


        echo " |" . PHP_EOL;

    }

    echo "+";

    for ($i = 0; $i < ($longestRecord + 2); $i++) {
        echo "-";

    }
    echo "+" . PHP_EOL;

}


/*
 * +-----------+
 * | aaa       |
 * | xx        |
 * | alexandru |
 * +-----------+
 */

function showMultiColumnTable($table)
{
    $record = 0;
    foreach ($table as $i => $value) {


        if ($record < count($table[$i])) {
            $record = count($table[$i]);

        }

    }
    $maxColumnLength = [];
    for ($i = 0; $i < $record; $i++) {
        $maxColumnLength[$i] = 0;

    }
    var_dump($maxColumnLength);
    foreach ($table as $index => $row) {
        foreach ($row as $indexCol => $value) {

            if (strlen($value) > $maxColumnLength[$indexCol]) {
                $maxColumnLength[$indexCol] = strlen($value);
            }
        }
    }


    for ($i2 = 0; $i2 < $record; $i2++) {
        echo "+";
        for ($i = 0; $i < $maxColumnLength[$i2]; $i++) {
            echo "-";
        }

    }
    echo "+" . PHP_EOL;

    for ($i4 = 0; $i4 < count($table); $i4++) {
        for ($i3 = 0; $i3 <= $record; $i3++) {
            echo "|";
            if (is_numeric($table[$i4][$i3])) {
                for ($i2 = 0; $i2 < ($maxColumnLength[$i3] - strlen($table[$i4][$i3])); $i2++) {
                    echo " ";
                }
                echo $table[$i4][$i3];
            } else {
                echo $table[$i4][$i3];
                for ($i2 = 0; $i2 < ($maxColumnLength[$i3] - strlen($table[$i4][$i3])); $i2++) {
                    echo " ";
                }
            }

        }
        echo PHP_EOL;
    }
    for ($i2 = 0; $i2 < $record; $i2++) {
        echo "+";
        for ($i = 0; $i < $maxColumnLength[$i2]; $i++) {
            echo "-";
        }

    }
    echo "+" . PHP_EOL;
}


showMultiColumnTable([
        ['aaa', 2, 245,433,64,44],
        [55, 'bla', 49638, 3, 4, 5, 6],
        ['alexandru', 123884, 'cutter']
    ]
);

/*
 * +---------+--------+------+
 * |aaa      |      2 |test  |
 * |xx       |     55 |bla   |
 * |alexandru| 123884 |cutter|
 * +---------+--------+------+
 */

