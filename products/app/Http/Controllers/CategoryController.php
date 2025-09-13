<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService
    )
    {}

    public function index(): JsonResponse
    {
        try {
            return $this->responseSuccess(data: ['categories' => $this->categoryService->getAll()]);
        } catch (\Exception $e) {
            return $this->responseError(message: $e->getMessage());
        }
    }

    public function store(CreateCategoryRequest $request): JsonResponse
    {
        try {
            $this->categoryService->create($request->getTitle());
            return $this->responseSuccess();
        } catch (\Exception $e) {
            return $this->responseError(message: $e->getMessage());
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return $this->responseSuccess(data: ['category' => $this->categoryService->getById($id)]);
        } catch (\Exception $e) {
            return $this->responseError(message: $e->getMessage());
        }
    }
}
