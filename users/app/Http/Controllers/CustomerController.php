<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public function __construct(
        public readonly CustomerService $customerService,
        public readonly CustomerRepository $customerRepository,
    )
    {}

    public function index(): JsonResponse
    {
        try {
            return $this->responseSuccess(data: ['customers' => $this->customerRepository->getAll()]);
        } catch (\Exception $e) {
            return $this->responseError(message: $e->getMessage());
        }
    }

    public function store(CreateCustomerRequest $request): JsonResponse
    {
        try {
            $this->customerService->create(
                $request->getName(),
                $request->getSurname(),
                $request->getEmail()
            );
            return $this->responseSuccess();
        } catch (\Exception $e) {
            return $this->responseError(message: $e->getMessage());
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return $this->responseSuccess(data: ['customer' => $this->customerRepository->getById($id)]);
        } catch (\Exception $e) {
            return $this->responseError(message: $e->getMessage());
        }
    }
}
