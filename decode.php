<?php

/**
 * Task 1: Decode secret word
 *
 * $data variable (defined below) is an array of digits, that represents binary data. Every element of array
 * is a single-byte char code.
 *
 * The task is to decompress gzipped binary data, then to decode the result as base 64 encoded string and
 * to print to output the result string - this is a secret word.
 *
 */

$data = [120, 156, 11, 204, 13, 43, 142, 140, 240, 50, 76, 174, 116, 181, 5, 0, 27, 141, 4, 18];

// write your code here...

echo base64_decode(implode(array_map('chr', $data)));