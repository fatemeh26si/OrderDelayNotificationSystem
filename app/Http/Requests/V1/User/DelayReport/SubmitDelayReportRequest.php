<?php

namespace App\Http\Requests\V1\User\DelayReport;

use Illuminate\Foundation\Http\FormRequest;

class SubmitDelayReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @OA\Schema(
     *       schema="SubmitDelayReportBodyApi",
     *       title="SubmitDelayReportBodyApi",
     *     @OA\Property(property="order_id", type="int",example="1"),
     *  ),
     */
    public function rules(): array
    {
        return [
            'order_id' => "required|int|exists:orders,id",
        ];
    }
}
