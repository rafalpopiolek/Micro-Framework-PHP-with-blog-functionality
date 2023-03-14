<?php

declare(strict_types = 1);

function dd(mixed $value): void
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}
