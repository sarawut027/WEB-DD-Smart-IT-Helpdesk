<?php
namespace App\Controllers;

use App\Repositories\TicketRepository;
use App\Services\TicketStatusService;
use App\Core\EventDispatcher;
use App\Observers\TicketObserver;
use App\Enums\TicketStatus;

class TicketController
{
    private TicketRepository $repo;
    private TicketStatusService $statusService;

    public function __construct()
    {
        $this->repo = new TicketRepository();
        $dispatcher = new EventDispatcher();

        // ลงทะเบียน Observer
        $dispatcher->listen('ticket.status_changed', [new TicketObserver(), 'handleStatusChanged']);

        $this->statusService = new TicketStatusService($this->repo, $dispatcher);
    }

    public function index(): void
    {
        $tickets = $this->repo->all();
        $this->render('tickets/index', ['tickets' => $tickets]);
    }

    public function updateStatus(): void
    {
        $ticketId = $_POST['ticket_id'] ?? 0;
        $statusStr = $_POST['status'] ?? '';
        $actorId = 1; // จำลองว่าแอดมิน ID 1 เป็นคนกด

        try {
            $newStatus = TicketStatus::from($statusStr);
            $this->statusService->transition((int) $ticketId, $newStatus, $actorId);

            $_SESSION['msg'] = "อัปเดตสถานะและส่งอีเมลเรียบร้อยแล้ว!";
        } catch (\Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header("Location: /");
        exit;
    }

    // Helper สำหรับโหลด View
    private function render(string $view, array $data = []): void
    {
        extract($data);
        ob_start();
        require __DIR__ . "/../../views/{$view}.php";
        $content = ob_get_clean();
        require __DIR__ . "/../../views/layout.php";
    }
}