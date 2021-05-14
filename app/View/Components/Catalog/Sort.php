<?php

namespace App\View\Components\Catalog;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class Sort extends Component
{
    public ?array $sortProps;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $sortProps, public Request $request)
    {
        $this->sortProps = $this->getProps($sortProps);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.catalog.sort');
    }

    /**
     * Возвращает нужный тип сортировки
     * @param $prop
     * @return string
     */
    private function getSortBy($prop): string
    {
        if (!isset($this->request->get('sort')['type'])) {
            return 'asc';
        }

        return $this->request->get('sort')['type'] === 'asc' &&
        $this->request->get('sort')['by'] === $prop
            ? 'desc' : 'asc';
    }

    /**
     * Класс для элемента сортировки
     * @param $prop
     * @return string
     */
    private function getClass($prop): string
    {
        if (!isset($this->request->get('sort')['type'])) {
            return '';
        }

        if (
            !$this->request->get('sort')['type'] ||
            $this->request->get('sort')['by'] !== $prop
        ) {
            return '';
        }

        return $this->request->get('sort')['type'] === 'asc'
            ? 'Sort-sortBy_inc'
            : 'Sort-sortBy_dec';
    }

    /**
     * Маршрут для сортировки
     * @param $prop
     * @param $sortBy
     * @return string
     */
    private function getHref($prop, $sortBy): string
    {
        return $this->request->fullUrlWithQuery(
            [
                'page' => 1,
                'sort[by]' => $prop,
                'sort[type]' => $sortBy,
            ]
        );
    }

    /**
     * Возвращает массив с данными для сортировки
     * @param string $props
     * @return array|null
     */
    private function getProps(string $props): ?array
    {
        if (!$props) {
            return null;
        }

        $propsArray = explode(',', $props);

        $propMap = [];
        foreach ($propsArray as $prop) {
            $class = $this->getClass($prop);

            $propMap[$prop] = [
                'class' => $class,
                'href' => $this->getHref($prop, $this->getSortBy($prop)),
            ];
        }

        return $propMap;
    }
}
