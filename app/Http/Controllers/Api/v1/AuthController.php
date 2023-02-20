<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * @OA\Post(
     * path="/register",
     * summary="registro de usuario",
     * description="registro de usuario",
     * operationId="authRegister",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="nombre, email y password",
     *    @OA\JsonContent(
     *       required={"name","email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="name", type="string", example="User1"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *    response=500,
     *    description="Error",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Error")
     *        )
     *     ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User Created Successfully")
     *        )
     *     )
     * )
     */

    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * @OA\Post(
     * path="/login",
     * summary="login de usuario",
     * description="login de usuario",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *   required=true,
     *  description="email y password",
     * @OA\JsonContent(
     *   required={"email","password"},
     *  @OA\Property(property="email", type="string", format="email", example="nico@gmail.com"),
     * @OA\Property(property="password", type="string", format="password", example="12345678"),
     * ),
     * ),
     * @OA\Response(
     *   response=500,
     * description="Error",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Error")
     * )
     * ),
     * @OA\Response(
     *  response=200,
     * description="Success",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="User Logged In Successfully"),
     * @OA\Property(property="token", type="string", example="1|2j3h4k5j6h7g8f9d0s1a2z3x4c5v6b7n8m9")
     * )
     * )
     *
     * )
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
