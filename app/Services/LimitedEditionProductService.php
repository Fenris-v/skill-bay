<?php


namespace App\Services;


use App\Repository\LimitedEditionProductRepository;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class LimitedEditionProductService
{
    /**
     * @var LimitedEditionProductRepository
     */
    private $limitedEditionProductRepository;

    /**
     * LimitedEditionProductService constructor.
     * @param LimitedEditionProductRepository
     */
    public function __construct(LimitedEditionProductRepository $limitedEditionProductRepository)
    {
        $this->limitedEditionProductRepository = $limitedEditionProductRepository;
    }

    /**
     * Возвращает товары с отметкой "Ограниченный тираж" из репозитория
     * @param int $amount
     * @return Product[]|Collection
     */
    public function get($amount = 16)
    {
        return $this->limitedEditionProductRepository->get($amount);
    }

    /**
     * Возвращает товар "Предложение дня" из репозитория
     * @return Product
     */
    public function getDailyOffer()
    {
        return $this->limitedEditionProductRepository->getDailyOffer();
    }
}
