<?php
session_start();
session_unset(); // All session variables remove
session_destroy(); // Session destroy

header("Location: login.php");
exit();
