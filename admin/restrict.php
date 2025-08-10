<?php

declare(strict_types=1);
session_start();

if (!isset($_SESSION['statusadmin']) || $_SESSION['statusadmin'] !== 'login') {
  http_response_code(401);
  header('Location: /login.php?pesan=auth_required');
  exit;
}