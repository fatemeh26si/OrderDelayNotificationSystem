<?php

namespace App\Http\Requests\V1\Agent\DelayReport;

use Illuminate\Foundation\Http\FormRequest;

class AssignDelayReportRequest extends FormRequest
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
     *       schema="RequestAssignDelayReportBodyApi",
     *       title="RequestAssignDelayReportBodyApi",
     *     @OA\Property(property="agent_number", type="int",example="100001", description="to recognize which agent has requested to assign?"),
     *  ),
     */
    public function rules(): array
    {
        return [
            'agent_number' => "required|int|exists:agents,agent_number",
        ];
    }
}
