<?php
/**
 * RAJERISON Julien phpstorm
 * 14 Mars 2019
 */

/**
 * Array Manipulations
 */
$array1 = ['1','2',3];
$array2 = [1,2,3];

if ($array1 == $array2) :
    echo 'equals';
else :
    echo 'not equals ';
endif;
// print equals

echo '<br>';
if ($array1 === $array2) :
    echo 'equals';
else :
    echo ' not equals ';
endif;
// print not equals

echo '<br>';
var_dump(array_diff($array1,$array2)); // will dump array(0) Because it compare just a value it will be to ==

echo '<br>';
var_dump(array_intersect($array1,$array2)); // will dump array(3) Because it compare a type and value it will be to ===

echo '<br>';
var_dump(array_push($array1,'4'),$array1); // will dump that array1 is a 4 element

echo '<br>';
var_dump(array_filter($array1,function ($array) {
    return (int)$array > (int)0; // return a value of array > 0
}));

$book_array = [
    ['id' => 1, 'title' => 'tree'],
    ['id' => 2, 'title' => 'sun'],
    ['id' => 3, 'title' => 'cloud'],
];

echo '<br>';
var_dump(array_unique($book_array)); // print a unique value in array return id 1 and tree because title and id is *3 here

echo '<br>';
var_dump(array_column($book_array,'id')); // print all id

echo '<br>';
var_dump(array_pad($array1,10,'12'),$array1); // complete array1 values to 10 content with "12"

echo '<br>';
var_dump(array_replace($array1,[1,2,3,4,5,6]),$array1); // replace the value of array 1 to [1,2,3,4,5,6]