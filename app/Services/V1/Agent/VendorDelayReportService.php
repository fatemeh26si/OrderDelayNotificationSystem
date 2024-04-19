<?PHP

namespace App\Services\V1\Agent;

use App\Repository\OrderRepositoryInterface;

class VendorDelayReportService
{

    private $orderRepository;
    public function __construct(
        OrderRepositoryInterface $orderRepository,
    )
    {
        $this->orderRepository = $orderRepository;
    }
    public function getReport($limit=null, $skip=null)
    {
        return $this->orderRepository->vendorDelayReports();
    }

}
