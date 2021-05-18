<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Pivots\ProductSpecification;
use App\Models\Specification;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class ProductSpecificationsLayout extends Rows
{
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
        $productId = $this->query->get('product')->id;

        $fields[] = ModalToggle::make(__('admin.product.specifications_edit'))
            ->modal('specificationModal')
            ->method('saveSpecifications')
            ->icon('settings');

        foreach ($this->query->get('product.specifications') as $specification) {
            $fields[] = $this->makeField($specification, $productId);
        }

        return $fields;
    }

    /**
     * Метод для создания поля
     * @param Model $model
     * @param int $productId
     * @return Field
     */
    private function makeField(Model $model, int $productId): Field
    {
        return match ($model->type) {
            Specification::SELECT, Specification::MULTIPLE => $this->makeSelect($model, $productId),
            Specification::CHECKBOX => $this->makeCheckbox($model),
        };
    }

    /**
     * Метод для создания поля ввода
     * @param Model $model
     * @param int $productId
     * @return Select
     */
    private function makeSelect(Model $model, int $productId): Select
    {
        $currentValue = ProductSpecification::where('specification_id', $model->id)
            ->where('product_id', $productId)
            ->first()
            ->value;

        return Select::make("product.specification.$model->id")
            ->title($model->title)
            ->required()
            ->taggable()
            ->fromQuery(
                ProductSpecification::where('specification_id', $model->id)
                    ->where('value', '!=', $currentValue),
                'value',
                'value',
            )->empty($currentValue, $currentValue);
    }

    /**
     * Метод для создания чекбокса
     * @param Model $model
     * @return CheckBox
     */
    private function makeCheckbox(Model $model): CheckBox
    {
        return CheckBox::make("product.specification.$model->id")
            ->value($model->pivot->value)
            ->placeholder($model->title)
            ->sendTrueOrFalse();
    }
}
