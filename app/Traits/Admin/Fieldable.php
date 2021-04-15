<?php

namespace App\Traits\Admin;

use App\Models\Admin\Config;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;

trait Fieldable
{
    /**
     * Метод для создания поля
     * @param Model $model
     * @return CheckBox|Input
     */
    private function makeField(Model $model): Field
    {
        switch ($model->type_id) {
            case Config::INT_TYPE:
                return $this->makeInput($model, 'number');
            case Config::CHECKBOX_TYPE:
                return $this->makeCheckbox($model);
            case Config::STRING_TYPE:
            default:
                return $this->makeInput($model, 'string');
        }
    }

    /**
     * Метод для создания поля ввода
     * @param Model $model
     * @param string $type
     * @return Input
     */
    private function makeInput(Model $model, string $type): Input
    {
        return Input::make($model->slug)
            ->title(__("admin.config.fields.{$model->slug}"))
            ->type($type)
            ->value($model->value)
            ->placeholder(__("admin.config.fields.{$model->slug}"));
    }

    /**
     * Метод для создания чекбокса
     * @param Model $model
     * @return CheckBox
     */
    private function makeCheckbox(Model $model): CheckBox
    {
        return CheckBox::make($model->slug)
            ->value($model->value)
            ->placeholder(__("admin.config.fields.{$model->slug}"))
            ->sendTrueOrFalse();
    }
}
