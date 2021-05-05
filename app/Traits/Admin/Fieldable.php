<?php

namespace App\Traits\Admin;

use App\Models\Admin\Config;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;

trait Fieldable
{
    /**
     * Метод для создания поля
     * @param Model $model
     * @return Field
     */
    private function makeField(Model $model): Field
    {
        return match ($model->type_id) {
            Config::INT_TYPE => $this->makeInput($model, 'number'),
            Config::CHECKBOX_TYPE => $this->makeCheckbox($model),
            Config::WYSIWYG_TYPE => $this->makeWysiwyg($model),
            default => $this->makeInput($model, 'string'),
        };
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
     * Метод для создания поля ввода
     * @param Model $model
     * @return Quill
     */
    private function makeWysiwyg(Model $model): Quill
    {
        return Quill::make($model->slug)
            ->title(__("admin.config.fields.{$model->slug}"))
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
