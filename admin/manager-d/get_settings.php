// get_settings.php
<?php
  session_start();
  include "./assets/include/config.php";

  $sql = "SELECT language, theme FROM _PDAdmin WHERE id = " . $_SESSION['admin_id'];
  $result = $conn->query($sql);
  $settings = $result->fetch_assoc();

  echo json_encode($settings);
  $conn->close();
?>