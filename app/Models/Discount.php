<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;
use DateTimeInterface;
use Illuminate\Support\Str;

class Discount extends Model
{
    use HasFactory;
    use AsSource;

    const PRODUCT = 1;
    const GROUP = 2;
    const CART = 3;

    const UNIT_PERCENT = 1;
    const UNIT_CURRENCY = 2;

    protected $dates = ['begin_at', 'end_at'];
    protected $fillable = [
        'title',
        'value',
        'description',
        'begin_at',
        'end_at',
        'unit_type',
        'type',
        'priority',
        'image_id',
        'conditions',
    ];
    protected $casts = [
        'conditions' => 'json',
    ];

    /**
     * Подготовить дату для отображения.
     *
     * @param  DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d.m.Y');
    }

    /**
     * Связь с наборами
     * @return HasMany
     */
    public function discountUnit(): HasMany
    {
        return $this->hasMany(DiscountUnit::class);
    }

    /**
     * Связь с картинкой
     */
    public function image()
    {
        return $this->belongsTo(Attachment::class, 'image_id');
    }

    /**
     * Получение списка константных типов скидок
     */
    public static function types()
    {
        return [
            self::PRODUCT,
            self::GROUP,
            self::CART,
        ];
    }

    /**
     * Получение списка константных способов расчета скидки
     */
    public static function unitTypes()
    {
        return [
            self::UNIT_PERCENT,
            self::UNIT_CURRENCY,
        ];
    }

    /**
     * Автоматическое генерирование slug
     *
     * @param string $title
     */
    public function setTitleAttribute(string $title)
    {
        $this->attributes['slug'] = Str::slug($title, '-');
        $this->attributes['title'] = $title;
    }
}
