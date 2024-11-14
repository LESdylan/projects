<?php
function isSocialNumberValid(string $number): bool
{
    // On vérifie le format
    if (!preg_match('/[12][0-9]{2}(0[1-9]|1[0-2])[0-9]{10}/', $number)) {
        return false;
    }

    // On vérifie la clef de contrôle
    $firstNumbers = (int)substr($number, 0, -2);
    $controlKey = (int)substr($number, -2);

    return (97 - ($firstNumbers % 97)) === $controlKey;
}

var_dump(isSocialNumberValid('369054958815780')); // false
var_dump(isSocialNumberValid('269134958815780')); // false
var_dump(isSocialNumberValid('26914958815780')); // false
var_dump(isSocialNumberValid('269054958815781')); // false
var_dump(isSocialNumberValid('199095145482285')); // true