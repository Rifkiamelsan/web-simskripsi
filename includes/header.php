<?php
/**
 * HEADER COMPONENT - SIMSKRIPSI
 */
if (!defined('BASE_URL')) require_once dirname(__DIR__) . '/config/auth.php';
$user = getAuthUser();
$pageTitle = $pageTitle ?? 'SIMSKRIPSI - Universitas Muhammadiyah Bengkulu';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/main.css">
  <!-- Chart.js for beautiful charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="app-wrapper">
