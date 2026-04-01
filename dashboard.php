<?php
// =============================================
// FILE: dashboard.php
// =============================================
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'config.php';

$events = [];
$sql = "SELECT id, description, year, date 
        FROM events 
        WHERE date >= CURDATE() 
        ORDER BY date ASC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Events Authenticator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Events Authenticator</a>
        <div class="navbar-nav ms-auto">
            <span class="nav-link text-white">Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?></span>
            <a href="logout.php" class="nav-link text-white"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4"><i class="fas fa-calendar-alt"></i> Upcoming Events</h2>
    
    <?php if (empty($events)): ?>
        <div class="alert alert-info">No upcoming events found.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($events as $event): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($event['description']) ?></h5>
                        <p class="card-text">
                            <strong>Year:</strong> <?= htmlspecialchars($event['year']) ?><br>
                            <strong>Date:</strong> <?= date("d M Y", strtotime($event['date'])) ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="authenticate.php?event_id=<?= $event['id'] ?>" 
                           class="btn btn-success w-100">
                            <i class="fas fa-qrcode"></i> Authenticate Members (OTP)
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>