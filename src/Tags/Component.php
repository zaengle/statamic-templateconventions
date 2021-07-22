<?php

namespace Zaengle\Templates\Tags;

use Statamic\Tags\Tags;

class Component extends Tags
{
    public function wildcard($tag)
    {
        $component = $this->params->get('src', $tag);

        $variables = array_merge($this->context->all(), $this->params->all(), [
            '__frontmatter' => $this->params->all(),
            'slot' => $this->isPair ? trim($this->parse()) : null,
        ]);

        return view($this->viewName($component), $variables)
            ->withoutExtractions()
            ->render();
    }

    protected function viewName($component)
    {
        $component = str_replace('/', '.', $component);

        if (view()->exists($underscored = $this->underscoredViewName($component))) {
            return $underscored;
        }

        if (view()->exists($subdirectoried = 'components.'.$component)) {
            return $subdirectoried;
        }

        if (view()->exists($underscored_subdirectoried = 'components.'.$this->underscoredViewName($component))) {
            return $underscored_subdirectoried;
        }

        return $component;
    }

    protected function underscoredViewName($component)
    {
        $bits = collect(explode('.', $component));

        $last = $bits->pull($bits->count() - 1);

        return $bits->implode('.').'._'.$last;
    }
}
