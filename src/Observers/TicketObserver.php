<?php
namespace App\Observers;

use App\Notifications\GmailService;

class TicketObserver
{
    public function handleStatusChanged(array $payload): void
    {
        $ticketId = $payload['ticket_id'];
        $newStatus = $payload['to'];

        $subject = "อัปเดตสถานะการแจ้งซ่อม: Ticket #{$ticketId}";
        $body = "
            <h3>ระบบ Helpdesk ได้อัปเดตสถานะงานของคุณ</h3>
            <p>Ticket ID: <b>{$ticketId}</b></p>
            <p>สถานะใหม่: <b style='color:blue;'>{$newStatus}</b></p>
        ";

        $mailer = new GmailService();
        // ในระบบจริงให้ Query อีเมลผู้รับจาก User ID สมมติส่งเข้าเมลทดสอบ
        $mailer->send('user.target@gmail.com', $subject, $body);
    }
}