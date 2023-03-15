<?php

declare(strict_types = 1);

/**
 * Create DI container
 * Add definitions to container
 * Return container instance
 */

$builder = new DI\ContainerBuilder();

$builder->addDefinitions(__DIR__ . '/../container/container-bindings.php');

return $builder->build();
