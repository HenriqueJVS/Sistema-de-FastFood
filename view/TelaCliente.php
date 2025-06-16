
<?php require __DIR__ . '/layout/header.php' ?>
<?php
if (isset($_SESSION['mensagem_pedido'])):
?>
    <p style="color: green;"><strong><?= $_SESSION['mensagem_pedido'] ?></strong></p>
<?php
    unset($_SESSION['mensagem_pedido']);
endif;
?>

<h2>Bem-vindo, <?= $_SESSION['usuario']->nome ?? 'cliente' ?>!</h2>

<?php
HomeController::exibirCardapio();

?>

<?php require __DIR__ . '/layout/footer.php' ?>
