<?php


namespace App\Services;

use App\Models\Product;
use App\Models\Visitor;
use App\Repository\ConfigRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\CompareProductRepository;
use Cache;

class CompareProductsService
{
    private $compareProductRepository;
    private $visitorService;

    /**
     * CompareProductsService constructor.
     * @param CompareProductRepository $compareProductRepository
     * @param VisitorService $visitorService
     */
    public function __construct(CompareProductRepository $compareProductRepository, VisitorService $visitorService)
    {
        $this->compareProductRepository = $compareProductRepository;
        $this->visitorService = $visitorService;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function add(Product $product) : bool
    {
        $visitor = $this->visitorService->get();
        if (!$this->compareProductRepository->contains($visitor, $product->id)) {
            $this->compareProductRepository->add($visitor, $product);

            return true;
        }

        return false;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function remove(Product $product) : bool
    {
        $visitor = $this->visitorService->get();
        if ($this->compareProductRepository->contains($visitor, $product->id)) {
            $this->compareProductRepository->remove($visitor, $product);

            return true;
        }

        return false;
    }

    /**
     * @param int $count
     * @return Collection|Product[]
     */
    public function getProducts($count = 3) : Collection|Array
    {
        return $this->compareProductRepository->get($this->visitorService->get(), $count);
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return $this->compareProductRepository->count($this->visitorService->get());
    }

}
