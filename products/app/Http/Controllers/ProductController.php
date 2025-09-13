<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Repositories\CategoryRepository;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService,
        private readonly CategoryRepository $categoryRepository,
    )
    {}

    public function index(): JsonResponse
    {
        try {
            return $this->responseSuccess(data: ['products' => $this->productService->getAll()]);
        } catch (\Exception $e) {
            return $this->responseError(message: $e->getMessage());
        }
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        try {
            $this->productService->create(
                $this->categoryRepository->getById($request->getCategoryId()),
                $request->getTitle(),
                $request->getPrice()
            );
            return $this->responseSuccess();
        } catch (\Exception $e) {
            return $this->responseError(message: $e->getMessage());
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return $this->responseSuccess(data: ['products' => $this->productService->getById($id)]);
        } catch (\Exception $e) {
            return $this->responseError(message: $e->getMessage());
        }
    }
}
