<?php

namespace App\Orchid\Layouts\Config;

use App\Traits\Admin\Fieldable;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;

class ConfigRowsLayout extends Rows
{
    use Fieldable;

    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        if (empty($this->query->get('configs'))) {
            return [];
        }

        $fields = [];
        foreach ($this->query->get('configs') as $item) {
            $fields[] = $this->makeField($item);
        }

        return $fields;
    }
}
