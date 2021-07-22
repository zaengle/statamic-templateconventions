<?php

namespace Zaengle\Templates;

use Statamic\Providers\AddonServiceProvider;
use Zaengle\Templates\Tags\Component;
use Zaengle\Templates\Tags\Field;

class ServiceProvider extends AddonServiceProvider
{
    /**
     * @var array
     */
    protected $tags = [
        Field::class,
        Component::class,
    ];
}
