<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Classes\ResponseApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\DelayReport\SubmitDelayReportRequest;
use App\Services\V1\User\DelayReportService;

class DelayReportController extends Controller
{
    private $delayReportService;


    public function __construct(
        DelayReportService $delayReportService
    )
    {
        $this->delayReportService = $delayReportService;
    }


    /**
     * @OA\Post(
     *      path="/api/v1/delay-report",
     *      operationId="SubmitDelayReport",
     *      tags={"User"},
     *      summary="SubmitDelayReport",
     *      description="SubmitDelayReport",
     *      @OA\RequestBody(
     *          description="Input data format",
     *          @OA\JsonContent(ref="#/components/schemas/SubmitDelayReportBodyApi" )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     *
     */


    public function submitDelayReport(SubmitDelayReportRequest $request)
    {

        $info = $this->delayReportService->submitDelayReport($request['order_id']);
        if ($info['success']) {
            return ResponseApi::success($info['data'] , $info['message']);
        } else {
            return ResponseApi::error($info['message']);
        }
    }


}
