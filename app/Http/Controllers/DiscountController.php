<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\DiscountRepository;

class DiscountController extends Controller
{
    public function __construct(
        protected DiscountRepository $discountRepository,
    ) {}

    public function index(Request $request)
    {
        return view('pages.main.discounts', [
            'discounts' => $this->discountRepository->getPaginateDiscounts((int) $request->page),
        ]);
    }
}
