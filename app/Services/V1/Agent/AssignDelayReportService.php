<?PHP

namespace App\Services\V1\Agent;

use App\Enums\DelayReportStatusEnum;
use App\Enums\TripStatusEnum;
use App\Repository\AgentDelayReportRepositoryInterface;
use App\Repository\AgentRepositoryInterface;
use App\Repository\DelayReportRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\TripRepositoryInterface;

class AssignDelayReportService
{

    private $orderRepository;
    private $tripRepository;
    private $delayReportRepository;
    private $agentRepository;
    private $agentDelayReportRepository;
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TripRepositoryInterface $tripRepository,
        DelayReportRepositoryInterface $delayReportRepository,
        AgentRepositoryInterface $agentRepository,
        AgentDelayReportRepositoryInterface $agentDelayReportRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->tripRepository = $tripRepository;
        $this->delayReportRepository = $delayReportRepository;
        $this->agentRepository = $agentRepository;
        $this->agentDelayReportRepository = $agentDelayReportRepository;
    }
    public function assignDelayReport($agentNumber) : array
    {
        $agent = $this->agentRepository->findByAgentNumber($agentNumber);
        if($this->agentDelayReportRepository->pendingReportOfAgent($agent['id'])){
            return [
                'success' => false,
                'data' => null,
                'message' => "شما در حال حاضر یک تاخیر در حال بررسی دارید و در حال حاضر سفارش دیگری به شما اختصاص نمی یابد."
            ];
        }

        $nextDelayReportInQueue = $this->delayReportRepository->notAssignedDelayInQueue();
        if($nextDelayReportInQueue){
            $this->agentDelayReportRepository->create([
                'agent_id' => $agent['id'],
                'delay_report_id' => $nextDelayReportInQueue['id'],
                'status' => DelayReportStatusEnum::PENDING->value,
                'description' => null,
            ]);
            return [
                'success' => true,
                'data' => $nextDelayReportInQueue,
                'message' => "سفارشی به شما تخصیص یافت. لطفا در اسرع وقت  آنرا بررسی نمایید."
            ];

        } else {
            return [
                'success' => true,
                'data' => null,
                'message' => "سفارشی در صف تاخیر جهت بررسی وجود ندارد. لطفا چند دقیقه ی دیگر مجددا درخواست نمایید."
            ];
        }
    }

}
