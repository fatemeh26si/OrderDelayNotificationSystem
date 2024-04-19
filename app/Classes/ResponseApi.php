<?php

namespace App\Classes;



class ResponseApi
{
    public function __construct()
    {
    }

    /**
     * @OA\Schema(
     *  schema="DefaultResultApi",
     *  title="DefaultResultApi",
     * 	    @OA\Property(
     *        property="data",
     *       type="object",
     *       example={}
     *     ),
     *     @OA\Property(
     *      property="status",
     *      type="int",
     *      example="200",
     *   ),
     *     @OA\Property(
     *      property="message",
     *      type="string",
     *      example="Welcome.",
     *   ),
     *  ),
     */
    public static function success($data , $message = null) {
        return response()->json([
            'data' => $data,
            'status' => 200,
            'message' => $message ?? "Successful",
        ], 200);
    }

    public static function error($error = null, $data = []) {
        return response()->json([
            'status' => 400,
            'data' => $data,
            'message' => $error ?? "Something is wrong!",
        ], 400);
    }

    public static function forbidden($error = null, $data = []) {
        return response()->json([
            'status' => 403,
            'data' => $data,
            'message' => $error ?? "Something is wrong!",
        ], 403);
    }

}


