<form action="index.php?controller=registrations&action=register" method="post">
    <input type="hidden" name="workshop_id" value="<?= htmlspecialchars($workshop_id) ?>">

    <div class="mb-3">
        <label for="user_name" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="user_name" name="user_name" required>
    </div>

    <div class="mb-3">
        <label for="user_email" class="form-label">Email</label>
        <input type="email" class="form-control" id="user_email" name="user_email" required>
    </div>

    <button type="submit" class="btn btn-primary">S'inscrire à l'atelier</button>
</form>