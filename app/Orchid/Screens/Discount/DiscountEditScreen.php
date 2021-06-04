<?php

namespace App\Orchid\Screens\Discount;

use App\Models\Discount;
use App\Models\DiscountUnit;
use App\Orchid\Layouts\Discount\TypeDiscountListener;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Alert;
use App\Http\Requests\DiscountRequest;
use Orchid\Support\Facades\Layout;

class DiscountEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.discount.edit.title_create';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'DiscountEditScreen';

    public $exists;

    private $discount;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Discount $discount): array
    {
        $this->exists = $discount->exists;
        if ($this->exists) {
            $this->name = __('admin.discount.edit.title_edit', ['name' => $discount->title]);
            $this->discount = $discount;
        }

        return compact('discount');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('admin.discount.edit.buttons.create'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
            Button::make(__('admin.discount.edit.buttons.save'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),
            Button::make(__('admin.discount.edit.buttons.remove'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        $prepare = fn(array $array, string $langKey)
            => array_reduce(
                $array,
                function($accum, $item) use ($langKey) {
                    $accum[$item] = __($langKey . $item);
                    return $accum;
                },
                []
            )
        ;

        return [
            Layout::tabs([
                __('admin.discount.requiredTab') => [
                    Layout::rows([
                        Input::make('discount.id')
                            ->required()
                            ->type('hidden'),
                        Input::make('discount.title')
                            ->required()
                            ->title(__('admin.discount.edit.labels.title')),
                        TextArea::make('discount.description')
                            ->rows(5)
                            ->required()
                            ->title(__('admin.discount.edit.labels.description')),
                        Input::make('discount.value')
                            ->required()
                            ->title(__('admin.discount.edit.labels.value')),
                        Select::make('discount.unit_type')
                            ->options($prepare(Discount::unitTypes(), 'admin.discount.unit_types.'))
                            ->required()
                            ->title(__('admin.discount.edit.labels.unit_type')),
                        Input::make('discount.priority')
                            ->required()
                            ->title(__('admin.discount.edit.labels.priority')),
                        Cropper::make('discount.image_id')
                            ->required()
                            ->targetId()
                            ->width(500)
                            ->height(300)
                            ->title('admin.discount.edit.labels.image'),
                    ]),
                ],
                __('admin.discount.relationTab') => [
                    Layout::rows([
                        Select::make('discount.type')
                            ->options($prepare(Discount::types(), 'admin.discount.types.'))
                            ->required()
                            ->title(__('admin.discount.edit.labels.type')),
                    ]),
                    TypeDiscountListener::class,
                ],
                __('admin.discount.optionalTab') => [
                    Layout::rows([
                        DateTimer::make('discount.begin_at')
                            ->title(__('admin.discount.edit.labels.begin_at'))
                            ->format('Y-m-d')
                            ->allowInput(),
                        DateTimer::make('discount.end_at')
                            ->title(__('admin.discount.edit.labels.end_at'))
                            ->format('Y-m-d')
                            ->allowInput(),
                    ]),
                ],
            ]),

        ];
    }

    protected function syncGroups(Discount $discount, array $units): void
    {
        $sync = function(string $relation, array $units, DiscountUnit $discountUnit) {
            if (array_key_exists($relation, $units)) {
                $discountUnit->$relation()->sync($units[$relation]);
            } else {
                $discountUnit->$relation()->detach();
            }
        };

        foreach($discount->discountUnit as $key => $discountUnit) {
            if (array_key_exists($key, $units)) {
                $sync('products', $units[$key], $discountUnit);
                $sync('categories', $units[$key], $discountUnit);
            } else {
                $discountUnit->delete();
            }
        }
        if ($discount->discountUnit->count() < 2 && $discount->type === Discount::GROUP) {
            $discount->type = Discount::PRODUCT;
            $discount->save();
        }
    }

    protected function createNewGroups(Discount $discount, array $units): void
    {
        foreach($units as $unit) {
            $discountUnit = DiscountUnit::factory(['discount_id' => $discount->id])
                ->create()
            ;
            $discountUnit->products()->attach($unit['products'] ?? []);
            $discountUnit->categories()->attach($unit['categories'] ?? []);
            $discount->discountUnit()->save($discountUnit);
        }

        $discount->save();
    }

    protected function saveGroups(Discount $discount, array $units): void
    {
        if ($discount->discountUnit->isNotEmpty()) {
            $this->syncGroups($discount, $units);
        } else {
            $this->createNewGroups($discount, $units);
        }
    }

    public function createOrUpdate(Discount $discount, DiscountRequest $request)
    {
        $discount->fill($request->get('discount'))->save();
        if ($discount->type !== Discount::CART) {
            $this->saveGroups($discount, $request->discount['discountUnit']);
        }

        Alert::info(
            __(
                $discount->wasRecentlyCreated
                    ? 'admin.discount.edit.success_create'
                    : 'admin.discount.edit.success_edit',
                ['name' => $discount->title]
            )
        );

        return redirect()->route('platform.discount.list');
    }

    public function remove(Discount $discount)
    {
        $discount->delete();

        Alert::info(
            __('admin.discount.edit.remove_edit', ['name' => $discount->name])
        );

        return redirect()->route('platform.discount.list');
    }

    public function asyncChooseUnit(int $type, int|null $id = null, int|null $amount): array
    {
        $discount = $id ? Discount::find($id) : new Discount();
        if ($amount === null && $type === Discount::GROUP) {
            $amount = 2;
        } else {
            $amount = match($type) {
                Discount::PRODUCT => 1,
                Discount::GROUP => $amount < 2 ? 2 : $amount,
                Discount::CART => null,
            };
        }

        return [
            'type' => $type,
            'amount' => $amount,
            'discount' => $discount,
        ];
    }
}
