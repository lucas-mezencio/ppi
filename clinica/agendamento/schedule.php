<?php
class RequestResponse {
  public $success;
  public $timeScheduled;

  public function __construct($success, $timeScheduled)
  {
    $this->success = $success;
    $this->timeScheduled = $timeScheduled;
  }
}

require "../db-connection.php";
$pdo = mysqlConnect();

$date = date(
  "Y-m-d",
  strtotime($_GET["date"]) ?? ""
);

try {
  $sql = <<<SQL
    select horario from tb_agenda
    where data_ = ?
SQL;
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$date]);
} catch (Exception $e) {
  exit('Erro: ' . $e->getMessage());
}

$timesArr = array();
while ($time = $stmt->fetch()) {
  $timesArr[] = htmlspecialchars($time['horario']);
}

if (count($timesArr) != 0) {
  $response = new RequestResponse(true, $timesArr);
} else {
  $response = new RequestResponse(false, null);
}
header('Content-type: application/json');
echo json_encode($response);
