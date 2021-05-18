<?php


namespace App\Services;


use App\Repository\LimitedEditionProductRepository;

class LimitedEditionProductService
{
    /**
     * @var LimitedEditionProductRepository
     */
    private $limitedEditionProductRepository;

    /**
     * LimitedEditionProductService constructor.
     *
     * @param LimitedEditionProductRepository
     */
    public function __construct(LimitedEditionProductRepository $limitedEditionProductRepository)
    {
        $this->limitedEditionProductRepository = $limitedEditionProductRepository;
    }

    public function get($amount = 16)
    {
        return $this->limitedEditionProductRepository->get($amount);
    }


    public function getDailyOffer()
    {
        return $this->limitedEditionProductRepository->getDailyOffer();
    }
}
