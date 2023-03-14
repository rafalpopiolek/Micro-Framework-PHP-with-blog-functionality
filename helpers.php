<?php

declare(strict_types = 1);

function dd(mixed $value): void
{
    echo "<pre style='border: 1px solid black; background-color: lightgray; padding: 5px;'>";
    print_r($value);
    echo "</pre>";
}
