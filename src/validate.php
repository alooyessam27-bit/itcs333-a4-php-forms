<?php
declare(strict_types=1);

/**
 * ITCS333 A4 starter — implement the three pure validation functions.
 * They are unit-tested by the autograder (tests/UnitTest.php).
 */

function validate_required(string $v): bool
{
    if (trim($v) !== '') {
        return true;
    }
    return false;
}

function validate_email(string $v): bool
{
 if (filter_var($v, FILTER_VALIDATE_EMAIL) !== false) {
        return true;
    }    return false;
}

function validate_length(string $v, int $min, int $max): bool
{
$length = mb_strlen($v, 'UTF-8');

    if ($length >= $min && $length <= $max) {
        return true;
    }    return false;
}
