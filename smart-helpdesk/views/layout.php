<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Smart IT Helpdesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white shadow-lg">
        <div class="container mx-auto font-bold text-xl">Smart IT Helpdesk (Custom OOP)</div>
    </nav>
    <main class="container mx-auto mt-8 p-4">
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    <?= $_SESSION['msg'];
                    unset($_SESSION['msg']); ?>
                </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
                </div>
        <?php endif; ?>

        <?= $content ?>
    </main>
</body>

</html>