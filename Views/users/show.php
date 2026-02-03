

<h1>Détails de l'utilisateur</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($user['name']) ?></h5>
        <p class="card-text"><strong>ID:</strong> <?= htmlspecialchars($user['id_user']) ?></p>
        <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p class="card-text"><strong>Créé le:</strong> <?= htmlspecialchars($user['created_at']) ?></p>
        
        <a href="index.php?controller=users&action=edit&id=<?= $user['id_user'] ?>" class="btn btn-warning">Éditer</a>
        <a href="index.php?controller=users&action=index" class="btn btn-secondary">Retour</a>
    </div>
</div>
