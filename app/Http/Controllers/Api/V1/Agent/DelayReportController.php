<?php

namespace App\Http\Controllers\Api\V1\Agent;

use App\Classes\ResponseApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Agent\DelayReport\AssignDelayReportRequest;
use App\Services\V1\Agent\AssignDelayReportService;
use App\Services\V1\Agent\VendorDelayReportService;
use Illuminate\Http\Request;

class DelayReportController extends Controller
{
    private $assignDelayReportService;
    private $vendorDelayReportService;

    public function __construct(
        AssignDelayReportService $assignDelayReportService,
        VendorDelayReportService $vendorDelayReportService
    )
    {
        $this->assignDelayReportService = $assignDelayReportService;
        $this->vendorDelayReportService = $vendorDelayReportService;
    }


    /**
     * @OA\Post(
     *      path="/api/v1/agent/delay-report/request-assign",
     *      operationId="RequestAssignDelayReport",
     *      tags={"Agent"},
     *      summary="RequestAssignDelayReport",
     *      description="RequestAssignDelayReport",
     *      @OA\RequestBody(
     *          description="Input data format",
     *          @OA\JsonContent(ref="#/components/schemas/RequestAssignDelayReportBodyApi" )
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


    public function requestAssign(AssignDelayReportRequest $request)
    {
        $info = $this->assignDelayReportService->assignDelayReport($request['agent_number']);
        if ($info['success']) {
            return ResponseApi::success($info['data'] , $info['message']);
        } else {
            return ResponseApi::error($info['message']);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/v1/agent/delay-report/vendor",
     *      operationId="GetVendorDelayReport",
     *      tags={"Agent"},
     *      summary="GetVendorDelayReport",
     *      description="GetVendorDelayReport",
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


    public function vendorDelayReport(Request $request)
    {
        $info = $this->vendorDelayReportService->getReport();
        return ResponseApi::success($info);
    }


}
