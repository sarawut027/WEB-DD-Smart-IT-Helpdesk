<h1 class="text-2xl font-bold mb-4 text-gray-700">รายการแจ้งซ่อมทั้งหมด</h1>
<div class="bg-white rounded shadow p-4">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">หัวข้อ</th>
                <th class="p-2 border">สถานะปัจจุบัน</th>
                <th class="p-2 border">อัปเดตสถานะ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets as $ticket): ?>
                <tr>
                    <td class="p-2 border text-center"><?= $ticket['id'] ?></td>
                    <td class="p-2 border"><?= htmlspecialchars($ticket['title']) ?></td>
                    <td class="p-2 border text-center">
                        <span
                            class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-sm"><?= $ticket['status'] ?></span>
                    </td>
                    <td class="p-2 border text-center">
                        <form action="/tickets/update-status" method="POST" class="inline-flex gap-2">
                            <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                            <select name="status" class="border p-1 rounded">
                                <option value="Open">Open</option>
                                <option value="Assigned">Assigned</option>
                                <option value="InProgress">In Progress</option>
                                <option value="Resolved">Resolved</option>
                                <option value="Closed">Closed</option>
                            </select>
                            <button type="submit"
                                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">เปลี่ยนสถานะ</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>