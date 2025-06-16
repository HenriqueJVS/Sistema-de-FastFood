<?php require __DIR__ . '/layout/header.php'; ?>

<h2><?= isset($atendente) ? 'Editar Atendente' : 'Cadastrar Novo Atendente' ?></h2>

<form method="post" action="index.php?pagina=<?= isset($atendente) ? 'gerente/editar_atendente' : 'gerente/adicionar_atendente' ?>">
    <?php if (isset($atendente)): ?>
        <input type="hidden" name="id" value="<?= $atendente->id ?>">
    <?php endif; ?>

    <label>Nome:</label><br>
    <input type="text" name="nome" required value="<?= $atendente->nome ?? '' ?>"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required value="<?= $atendente->email ?? '' ?>"><br><br>

    <?php if (!isset($atendente)): ?>
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>
    <?php endif; ?>

    <label>CPF:</label><br>
    <input type="text" name="cpf" required value="<?= $atendente->cpf ?? '' ?>"><br><br>

    <label>Data de Nascimento:</label><br>
    <input type="date" name="data_nascimento" required value="<?= $atendente->data_nascimento ?? '' ?>"><br><br>

    <button type="submit"><?= isset($atendente) ? 'Salvar Alterações' : 'Cadastrar' ?></button>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>
