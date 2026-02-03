<?php

// Affichage de la liste de toutes les réservations si connecté en admin 
if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3):
?>
    <h1>Liste des Réservations (Admin)</h1>
    
    <!-- Formulaire de recherche et filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="index.php" class="row g-3">
                <input type="hidden" name="controller" value="reservations">
                <input type="hidden" name="action" value="index">
                
                <!-- Barre de recherche -->
                <div class="col-md-6">
                    <label for="search" class="form-label">Rechercher</label>
                    <input type="text" 
                           class="form-control" 
                           id="search" 
                           name="search" 
                           placeholder="Nom d'utilisateur ou atelier..." 
                           value="<?= htmlspecialchars($search ?? '') ?>">
                </div>
                
                <!-- Tri -->
                <div class="col-md-4">
                    <label for="sort" class="form-label">Trier par</label>
                    <select class="form-select" id="sort" name="sort">
                        <option value="workshop" <?= ($sortBy ?? '') === 'workshop' ? 'selected' : '' ?>>Atelier (A-Z)</option>
                        <option value="date" <?= ($sortBy ?? '') === 'date' ? 'selected' : '' ?>>Date de réservation (récent)</option>
                        <option value="event_date" <?= ($sortBy ?? '') === 'event_date' ? 'selected' : '' ?>>Date de l'événement</option>
                    </select>
                </div>
                
                <!-- Boutons -->
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Filtrer
                    </button>
                    <a href="index.php?controller=reservations&action=index" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

<?php else: ?>
    <h1>Mes Réservations</h1>
<?php endif; ?>

<!-- Affichage du nombre de résultats -->
<?php if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3): ?>
    <p class="text-muted">
        <?= count($reservations) ?> réservation(s) trouvée(s)
        <?php if (!empty($search)): ?>
            pour "<?= htmlspecialchars($search) ?>"
        <?php endif; ?>
    </p>
<?php endif; ?>

<?php if (empty($reservations)): ?>
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> 
        Aucune réservation trouvée.
        <?php if (!empty($search)): ?>
            <a href="index.php?controller=reservations&action=index" class="alert-link">Voir toutes les réservations</a>
        <?php endif; ?>
    </div>
    <?php if (!isset($_SESSION['id_role']) || $_SESSION['id_role'] != 3): ?>
        <a href="index.php?controller=workshops&action=index" class="btn btn-primary">Voir les ateliers disponibles</a>
    <?php endif; ?>
<?php else: ?>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <?php if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3): ?>
                    <th>Utilisateur</th>
                <?php endif; ?>
                <th>Atelier</th>
                <th>Date de l'événement</th>
                <th>Date de réservation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?= $reservation['id_reservation'] ?></td>
                    <?php if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3): ?>
                        <td>
                            <i class="fas fa-user"></i> 
                            <?= htmlspecialchars($reservation['user_name'] ?? 'N/A') ?>
                            <br>
                            <small class="text-muted"><?= htmlspecialchars($reservation['user_email'] ?? '') ?></small>
                        </td>
                    <?php endif; ?>
                    <td><?= htmlspecialchars($reservation['title']) ?></td>
                    <td>
                        <i class="fas fa-calendar"></i> 
                        <?= date('d/m/Y à H:i', strtotime($reservation['event_date'])) ?>
                    </td>
                    <td>
                        <i class="fas fa-clock"></i> 
                        <?= date('d/m/Y à H:i', strtotime($reservation['reservation_date'])) ?>
                    </td>
                    <td>
                        <a href="index.php?controller=reservations&action=show&id=<?= $reservation['id_reservation'] ?>" 
                           class="btn btn-sm btn-info" 
                           title="Voir les détails">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="index.php?controller=reservations&action=cancel&id=<?= $reservation['id_reservation'] ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Annuler cette réservation ?')"
                           title="Annuler">
                            <i class="fas fa-times"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>