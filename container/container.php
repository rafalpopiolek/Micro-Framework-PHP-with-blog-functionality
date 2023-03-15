<?php

declare(strict_types = 1);

$builder = new DI\ContainerBuilder();

$builder->addDefinitions(__DIR__ . '/../container/container-bindings.php');

return $builder->build();
