<?php require __DIR__ . '/layout/header.php' ?>

<?php
require_once __DIR__ . '/../controllers/HomeController.php';
?>

<?php HomeController::exibirCardapio(); ?>

<?php require __DIR__ . '/layout/footer.php' ?>