<h2><?= isset($atendente) ? 'Editar' : 'Adicionar' ?> Atendente</h2>

<form method="post" action="index.php?pagina=<?= isset($atendente) ? 'gerente/editar_atendente' : 'gerente/adicionar_atendente' ?>">
    <?php if (isset($atendente)): ?>
        <input type="hidden" name="id" value="<?= $atendente->id ?>">
    <?php endif; ?>

    <label>Nome:</label>
    <input type="text" name="nome" value="<?= $atendente->nome ?? '' ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $atendente->email ?? '' ?>" required><br>

    <label>CPF:</label>
    <input type="text" name="cpf" value="<?= $atendente->cpf ?? '' ?>" required><br>

    <label>Data de Nascimento:</label>
    <input type="date" name="data_nascimento" value="<?= $atendente->data_nascimento ?? '' ?>" required><br>

    <label>Matrícula:</label>
    <input type="text" name="matricula" value="<?= $atendente->matricula ?? '' ?>" required><br>

    <?php if (!isset($atendente)): ?>
        <label>Senha:</label>
        <input type="password" name="senha" required><br>
    <?php endif; ?>

    <button type="submit">Salvar</button>
</form>
