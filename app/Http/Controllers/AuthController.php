<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\VerifyEmailService;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Contracts\VerifyInterface;
use App\Http\Requests\VerifyRequest;
use App\Models\User;

use function PHPUnit\Framework\returnSelf;

class AuthController extends BaseController
{
    // Holds an instance of the AuthService for handling authentication logic.
    protected $authService;

    /**
     * Constructor to inject the AuthService.
     *
     * @param AuthService $authService The service responsible for authentication logic.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handles user registration.
     *
     * @param RegisterRequest $request The validated registration request.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the JWT token or an error message.
     */

    /**
     * @OA\Get(
     *     path="/api/register",
     *     summary="Register a new user",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="User's name"
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="User's email"
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="User's password"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful registration",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 description="JWT token"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="We have an internal problem!"
     *             )
     *         )
     *     )
     * )
     */

    public function register(RegisterRequest $request)
    {
        try {
            // Call the AuthService to register the user and generate a JWT token.
            $token = $this->authService->register($request);
            // Return the token in a standardized response format.
            return $this->responseWithToken($token);
        } catch (\Throwable $th) {
            // Handle any unexpected errors and return a 500 Internal Server Error response.
            return $this->response([], "We have an internal problem!", 500);
        }
    }

    /**
     * Handles user login.
     *
     * @param LoginRequest $request The validated login request.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the JWT token or an error message.
     */
    public function login(LoginRequest $request)
    {
        try {
            // Call the AuthService to authenticate the user and generate a JWT token.
            $token = $this->authService->login($request);
            // Return the token in a standardized response format.
            return $this->responseWithToken($token);
        } catch (\Throwable $th) {
            // Handle any unexpected errors and return a 500 Internal Server Error response.
            return $this->response([], "We have an internal problem!", 500);
        }
    }

    /**
     * Retrieves the authenticated user's details.
     *
     * @return \Illuminate\Http\JsonResponse Returns the authenticated user's data.
     */
    public function me()
    {
        return auth()->user();
    }

    /**
     * Handles user logout.
     *
     * @return \Illuminate\Http\JsonResponse Returns a success response.
     */
    public function logout()
    {
        // Log the user out.
        auth()->logout();
        // Return a success response.
        return $this->response();
    }

    /**
     * Refreshes the JWT token.
     *
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the new JWT token.
     */
    public function refresh()
    {
        // Refresh the JWT token.
        $token = JWTAuth::refresh();
        // Return the new token in a standardized response format.
        return $this->responseWithToken($token);
    }

    /**
     * Handles email verification.
     *
     * @param VerifyRequest $request The validated verification request.
     * @return \Illuminate\Http\JsonResponse Returns a success or error response.
     */
    public function verify(VerifyRequest $request)
    {
        // Check if the verification link has a valid signature.
        if (!$request->hasValidSignature()) {
            return $this->response([], "The verify link is expired!", 419);
        }
        try {
            // Find the user by ID.
            $user = User::findOrFail($request->input("id"));
            // Call the AuthService to verify the user's email.
            $status = $this->authService->verify($user, $request->input("code"));
            // Return a success response if verification is successful, otherwise return an error.
            return $status ? $this->response() : $this->response([], "The sent code is not true may be you wanna HACK us :))");
        } catch (\Throwable $th) {
            // Handle any unexpected errors and return a 500 Internal Server Error response.
            $this->response([], "There is internal problem!", 500);
        }
    }
}
