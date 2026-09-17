<?php
namespace App\Services;

use App\Repositories\TicketRepository;
use App\Core\EventDispatcher;
use App\Enums\TicketStatus;

class TicketStatusService
{
    private TicketRepository $repo;
    private EventDispatcher $events;

    public function __construct(TicketRepository $repo, EventDispatcher $events)
    {
        $this->repo = $repo;
        $this->events = $events;
    }

    public function transition(int $ticketId, TicketStatus $newStatus, int $actorId): void
    {
        $ticket = $this->repo->find($ticketId);
        if (!$ticket)
            throw new \Exception("ไม่พบข้อมูล Ticket");

        $currentStatus = TicketStatus::from($ticket['status']);

        $this->repo->updateStatus($ticketId, $newStatus->value);
        $this->repo->logStatusChange($ticketId, $actorId, $currentStatus->value, $newStatus->value);

        // ยิง Event ให้ Observer ทำงาน (เช่น ส่ง Email)
        $this->events->dispatch('ticket.status_changed', [
            'ticket_id' => $ticketId,
            'from' => $currentStatus->value,
            'to' => $newStatus->value,
            'actor_id' => $actorId
        ]);
    }
}