<?php

namespace App\Services;

use App\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    public CategoryRepository $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Collection
     */
    public function getTree(): Collection
    {
        return $this->categoryRepository->getTree();
    }
}
