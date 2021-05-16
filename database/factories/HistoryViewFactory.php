<?php

namespace Database\Factories;

use App\Models\HistoryView;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HistoryView::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $userId = User::inRandomOrder()->take(1)->pluck('id')->first(),
            'product_id' => Product::inRandomOrder()
                ->whereDoesntHave(
                    'historyViews',
                    fn(Builder $query) => $query->where('user_id', $userId)
                )
                ->take(1)->pluck('id')->first()
            ,
            'created_at' => now()->subDays(rand(31, 60)),
            'updated_at' => now()->subDays(rand(1, 30))
        ];
    }
}
