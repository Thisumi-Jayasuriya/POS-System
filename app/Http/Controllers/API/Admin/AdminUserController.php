<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Repositories\All\User\UserRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminUserController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function index(Request $request): JsonResponse
    {
        try {
            $users = $this->userRepository->all(['*']);

            return response()->json([
                'status' => true,
                'message' => 'Users retrieved successfully.',
                'data' => $users
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve users.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(UserRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $user = $this->userRepository->create($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'User created successfully.',
                'data' => $user
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create user.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $user = $this->userRepository->findById((int) $id, ['*']);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'User retrieved successfully.',
                'data' => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'User not found.'], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UserRequest $request, string $id): JsonResponse
    {
        try {
            $user = $this->userRepository->findById((int) $id, ['*']);

            if (!$user) {
                return response()->json(['status' => false, 'message' => 'User not found.'], 404);
            }

            $validatedData = $request->validated();
            $this->userRepository->update((int) $id, $validatedData);

            return response()->json([
                'status' => true,
                'message' => 'User updated successfully.',
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $user = $this->userRepository->findById((int) $id, ['*']);

            if (!$user) {
                return response()->json(['status' => false, 'message' => 'User not found.'], 404);
            }

            $this->userRepository->deleteById((int) $id);

            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
