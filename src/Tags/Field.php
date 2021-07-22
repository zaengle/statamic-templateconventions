<?php

namespace Zaengle\Templates\Tags;

use Statamic\Tags\Tags;

class Field extends Tags
{
    public function wildcard($tag)
    {
        $field = $this->params->get('src', $tag);

        $variables = array_merge($this->context->all(), $this->params->all(), [
            '__frontmatter' => $this->params->all(),
            'slot' => $this->isPair ? trim($this->parse()) : null,
        ]);

        return view($this->viewName($field), $variables)
            ->withoutExtractions()
            ->render();
    }

    protected function viewName($field)
    {
        $field = str_replace('/', '.', $field);

        if (view()->exists($underscored = $this->underscoredViewName($field))) {
            return $underscored;
        }

        if (view()->exists($subdirectoried = 'fields.'.$field)) {
            return $subdirectoried;
        }

        if (view()->exists($underscored_subdirectoried = 'fields.'.$this->underscoredViewName($field))) {
            return $underscored_subdirectoried;
        }

        return $field;
    }

    protected function underscoredViewName($field)
    {
        $bits = collect(explode('.', $field));

        $last = $bits->pull($bits->count() - 1);

        return $bits->implode('.').'._'.$last;
    }
}
