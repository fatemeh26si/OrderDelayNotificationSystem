<?PHP

namespace App\Services\V1\User;

use App\Enums\DelayReportStatusEnum;
use App\Enums\TripStatusEnum;
use App\Repository\DelayReportRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\TripRepositoryInterface;

class DelayReportService
{

    private $orderRepository;
    private $tripRepository;
    private $delayReportRepository;
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TripRepositoryInterface $tripRepository,
        DelayReportRepositoryInterface $delayReportRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->tripRepository = $tripRepository;
        $this->delayReportRepository = $delayReportRepository;
    }
    public function submitDelayReport($orderId) : array
    {
        $order = $this->orderRepository->orderWithDeliveryInfo($orderId);
        if (!$order['was_delayed']) {
            return [
                'success' => false,
                'data' => null,
                'message' => __('userMessage.delayed.was_not_delayed')
            ];
        }

        $newDeliveryEstimateTime = $order['new_delivery_estimate_time'];
        if($newDeliveryEstimateTime > now()){
            return [
                'success' => false,
                'data' => null,
                'message' => __('userMessage.delayed.error_new_delivery_time', ['time'=>$newDeliveryEstimateTime])
            ];
        }

        $trip = $this->tripRepository->tripInfo($orderId);

        $eta = null;
        $success = false;
        $message = null;

        if (!$trip || $trip[TripStatusEnum::DELIVERED->value]) {
           $lastRequestOfOrderInQueue = $this->delayReportRepository->lastRequestOfOrderInQueue($orderId);
           if($lastRequestOfOrderInQueue['id'] && $lastRequestOfOrderInQueue['status'] != DelayReportStatusEnum::CHECKED->value){  //if status is null or PENDING
             return [
                   'success' => true,
                   'data' => null,
                   'message' => __('userMessage.delayed.duplicate_request')
               ];
           } else {
               $success = true;
               $message = __('userMessage.delayed.submit_request_in_queue');
           }

        }

        if($trip && !$trip[TripStatusEnum::DELIVERED->value]){
            $eta = $this->newDeliveryTime();
            $success = true;
            $message = __('userMessage.delayed.new_delivery_time', ['eta'=>$eta]);
        }

        $this->delayReportRepository->create([
            'order_id'=> $orderId,
            'estimate_delivery_time'=> $eta,
            'request_date'=> now(),
        ]);
        return [
            'success' => $success,
            'data' => null,
            'message' => $message
        ];
    }

    private function newDeliveryTime()
    {
        return 10;
//        return rand(1, 4)*10;
    }
}
