<?php
namespace App\Enums;

enum TicketStatus: string
{
    case OPEN = 'Open';
    case ASSIGNED = 'Assigned';
    case IN_PROGRESS = 'InProgress';
    case RESOLVED = 'Resolved';
    case CLOSED = 'Closed';
}