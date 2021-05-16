<?php


namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\CompareProductRepository;

class CompareProductsService
{
    private $compareProductRepository;

    /**
     * @param CompareProductRepository $compareProductRepository
     */
    public function __construct(CompareProductRepository $compareProductRepository)
    {
        $this->compareProductRepository = $compareProductRepository;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function add(Product $product) : bool
    {
        if (!$this->compareProductRepository->contains($product->id)) {
            $this->compareProductRepository->add($product);

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
        if ($this->compareProductRepository->contains($product->id)) {
            $this->compareProductRepository->remove($product);

            return true;
        }

        return false;
    }

    /**
     * @param int $count
     * @return Collection|Array
     */
    public function getProducts($count = 3) : Collection|Array
    {
        return $this
            ->compareProductRepository
            ->get()
            ->load('images')
            ->load('specifications')
            ->take($count);
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return $this
            ->compareProductRepository
            ->count();
    }

}
