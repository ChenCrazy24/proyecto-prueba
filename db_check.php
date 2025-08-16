<?php
$host ="practicas-db.cxqkeuegshfy.us-east-2.rds.amazonaws.com";
$user = "nowyapp";
$pass = "CambiaEstaContraseñaSegura123!";
$db   = "nowy_staging";
$port = 3306;

header("Content-Type: text/plain; charset=utf-8");

$mysqli = @new mysqli($host, $user, $pass, $db, $port);

if ($mysqli->connect_errno) {
  http_response_code(500);
  echo "ERROR de conexión (" . $mysqli->connect_errno . "): " . $mysqli->connect_error . PHP_EOL;
  exit;
}

$res = $mysqli->query("SELECT id, note, created_at FROM healthcheck ORDER BY id DESC LIMIT 1");
if (!$res) {
  http_response_code(500);
  echo "Consulta falló: " . $mysqli->error . PHP_EOL;
  exit;
}

$row = $res->fetch_assoc();
echo "Conexión RDS: OK\n";
echo "Último registro -> id={$row['id']}, note={$row['note']}, created_at={$row['created_at']}\n";

$mysqli->close();
