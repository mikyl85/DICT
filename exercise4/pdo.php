<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc','root', '');

//$pdo = new PDO('mysql:host=localhost;port=5432;dbname=misc','postgres', 'new-password');

// See the "errors"
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

