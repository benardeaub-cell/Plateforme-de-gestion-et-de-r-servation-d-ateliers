
<h1>Liste des Ateliers</h1>



<?php 
// Message pour les utilisateurs non connectés
if (!isset($_SESSION['user_id'])): ?>
<h4>Vous devez être connecté pour vous inscrire</h4>
<?php endif; ?>

<?php 
// Bouton pour ajouter un atelier (admin uniquement)
if (isset($_SESSION['user_id']) && isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3): ?>
<a href="index.php?controller=workshops&action=create"><button type="button" class="btn btn-primary">Ajouter un Atelier</button></a>
<?php endif; ?>

<?php 
// Formulaire de recherche et filtres 
?>
<form method="GET" action="index.php" class="row g-3 my-4">
    <input type="hidden" name="controller" value="workshops">
    <input type="hidden" name="action" value="index">
    
    <!-- Barre de recherche -->
    <div class="col-md-6">
        <label for="search" class="form-label">Rechercher</label>
        <input type="text" 
               class="form-control" 
               id="search" 
               name="search" 
               placeholder="Titre de l'atelier..." 
               value="<?= htmlspecialchars($search ?? '') ?>">
    </div>
    
    <!-- Filtre par catégorie -->
    <div class="col-md-4">
        <label for="category" class="form-label">Catégorie</label>
        <select class="form-select" id="category" name="category">
            <option value="">Toutes les catégories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id_category'] ?>" <?= (isset($selectedCategory) && $selectedCategory == $category['id_category']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <!-- Boutons -->
    <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary me-2">
            <i class="fas fa-search"></i> Filtrer
        </button>
        <a href="index.php?controller=workshops&action=index" class="btn btn-secondary">
            <i class="fas fa-redo"></i> Réinitialiser
        </a>
    </div>
</form>


<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Date</th>
            <th scope="col">Heure</th>
            <th scope="col">Places disponibles</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($workshops as $workshop) {
            echo "<tr>";
            echo "<td>" . $workshop['id_workshop'] . "</td>";
            echo "<td>" . htmlspecialchars($workshop['title']) . "</td>";
            echo "<td>" . date('d-m-Y', strtotime($workshop['event_date'])) . "</td>";
            echo "<td>" . date('H:i', strtotime($workshop['event_date'])) . "</td>";
            echo "<td>" . $workshop['available_places'] . " / " . $workshop['total_places'] . "</td>";
            echo "<td>" . htmlspecialchars($workshop['category_name'] ?? 'N/A') . "</td>";
            echo "<td>";

            // Si pas connecté : afficher lien de connexion
            // Si connecté : verifier si des places sont dispo et afficher lien d'inscription
            if (!isset($_SESSION['user_id'])) {
                echo "<a href='index.php?controller=auth&action=login'>Se Connecter</a> ";
            } else {
                if ($workshop['available_places'] > 0) {
                    echo "<a href='index.php?controller=reservations&action=register&workshop_id=" . $workshop['id_workshop'] . "'><i class='fas fa-user-plus'></i></a> ";
                } else {
                    echo "Complet";
                }
            }

            // Si déjà inscrit afficher message de confirmation
            if (isset($_SESSION['user_id'])) {
                $reservationsModel = new \workshop_platform\Models\ReservationsModel();
                if ($reservationsModel->checkReservationExists($_SESSION['user_id'], $workshop['id_workshop'])) {
                    echo "<span title='Vous êtes déjà inscrit à cet atelier'><i class='fas fa-check-circle text-success'></i></span> ";
                }

            }
            
            // Liens CRUD uniquement pour les admins (id_role = 3)
            if (isset($_SESSION['user_id']) && isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3) {
                echo "<a href='index.php?controller=workshops&action=show&id=" . $workshop['id_workshop'] . "'><i class='fas fa-eye'></i></a> ";
                echo "<a href='index.php?controller=workshops&action=edit&id=" . $workshop['id_workshop'] . "'><i class='fas fa-pen'></i></a> ";
                echo "<a href='index.php?controller=workshops&action=delete&id=" . $workshop['id_workshop'] . "' onclick='return confirm(\"Êtes-vous sûr ?\")'><i class='fas fa-trash'></i></a>";
            }
            
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>