
<h1>Éditer un utilisateur</h1>

<form action="index.php?controller=users&action=update" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id_user']) ?>">
    
    <div class="mb-3">
        <label for="name" class="form-label">Nom:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">Nouveau mot de passe:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
    <a href="index.php?controller=users&action=index" class="btn btn-secondary">Annuler</a>
</form>