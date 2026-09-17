<?php
namespace App\Repositories;

use App\Core\Database;
use PDO;

class TicketRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all(): array
    {
        return $this->db->query("SELECT * FROM tickets ORDER BY created_at DESC")->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function updateStatus(int $ticketId, string $status): bool
    {
        $stmt = $this->db->prepare("UPDATE tickets SET status = ?, updated_at = NOW() WHERE id = ?");
        return $stmt->execute([$status, $ticketId]);
    }

    public function logStatusChange(int $ticketId, int $userId, string $from, string $to): void
    {
        $stmt = $this->db->prepare("INSERT INTO status_logs (ticket_id, changed_by, from_status, to_status, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$ticketId, $userId, $from, $to]);
    }
}