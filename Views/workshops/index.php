
<h1>Liste des Ateliers</h1>



<?php 
// Message pour les utilisateurs non connectés
if (!isset($_SESSION['user_id'])): ?>
<h4>Vous devez être connecté pour vous inscrire</h4>
<?php endif; ?>

<?php 
// Bouton pour ajouter un atelier (admin uniquement)
if (isset($_SESSION['user_id']) && isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3): ?>
<button id="btn-add-atelier">Ajouter un atelier</button>



<!-- Modal pour l'ajout d'un atelier--> 
<div class="modal-overlay-add" role="dialog" aria-hidden="true" aria-labelledby="modal-title" hidden>
    <div id="workshopModal">
        <h2 id="modal-title">Ajouter un atelier</h2>
        <form id="form-add-atelier" method="POST">
        <label>Titre <input name="title" required /></label>
        <label>Date <input name="event_date" type="date" required /></label>
        <label>Heure <input name="event_time" type="time" required /></label>
        <label>Places Totales <input name="total_places" type="number" required /></label>
        <label>Places Disponibles <input name="available_places" type="number" required /></label>
        <label>Catégorie <select name="id_category" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id_category'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select></label>
        <label>Description <textarea name="description"></textarea></label>
            <div class="modal-actions">
                <button type="submit">Ajouter</button>
                <button type="button" id="closeModal"><i class="fas fa-times"></i>Annuler</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal pour l'edit d'un atelier -->
<div class="modal-overlay-edit" role="dialog" aria-hidden="true" aria-labelledby="modal-title" hidden>
    <div id="workshopModal">
        <h2 id="modal-title">Modifier un atelier</h2>
        <form id="form-edit-atelier" method="POST">
        <input type="hidden" name="id_workshop" />
        <label>Titre <input name="title" required /></label>
        <label>Date <input name="event_date" type="date" required /></label>
        <label>Heure <input name="event_time" type="time" required /></label>
        <label>Places Totales <input name="total_places" type="number" required /></label>
        <label>Places Disponibles <input name="available_places" type="number" required /></label>
        <label>Catégorie <select name="id_category" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id_category'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select></label>
        <label>Description <textarea name="description"></textarea></label>
            <div class="modal-actions">
                <button type="submit">Modifier</button>
                <button type="button" id="closeModalEdit">Annuler</button>
            </div>
        </form>
    </div>
</div>
      
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


<table class="table" id="workshops-table">
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
        $reservationsModel = null;
        if (isset($_SESSION['user_id'])) {
            $reservationsModel = new \workshop_platform\Models\ReservationsModel();
        }

        foreach ($workshops as $workshop) {
            echo "<tr>";
            echo "<tr id='workshop-".$workshop['id_workshop']."' data-id='".$workshop['id_workshop']."'>";
            echo "<td>" . $workshop['id_workshop'] . "</td>";
            echo "<td>" . htmlspecialchars($workshop['title']) . "</td>";
            echo "<td>" . date('d-m-Y', strtotime($workshop['event_date'])) . "</td>";
            echo "<td>" . date('H:i', strtotime($workshop['event_date'])) . "</td>";
            echo "<td>" . $workshop['available_places'] . " / " . $workshop['total_places'] . "</td>";
            echo "<td>" . htmlspecialchars($workshop['category_name'] ?? 'N/A') . "</td>";
            echo "<td>";

            $isAlreadyRegistered = false;
            if ($reservationsModel) {
                $isAlreadyRegistered = $reservationsModel->checkReservationExists($_SESSION['user_id'], $workshop['id_workshop']);
            }

            // Si pas connecté : afficher lien de connexion
            // Si connecté : verifier si des places sont dispo et afficher lien d'inscription
             if (!isset($_SESSION['user_id'])) {
                echo "<a href='index.php?controller=auth&action=login'>Se Connecter</a> ";
            } elseif ($isAlreadyRegistered) {
                echo "<span title='Vous êtes déjà inscrit à cet atelier'><i class='fas fa-check-circle text-success'></i></span> ";
            } else {
                if ($workshop['available_places'] > 0) {
                    echo "<a href='index.php?controller=reservations&action=register&workshop_id=" . $workshop['id_workshop'] . "'><i class='fas fa-user-plus'></i></a> ";
                } else {
                    echo "Complet";
                }
            }
            
            // Liens CRUD uniquement pour les admins (id_role = 3)
             if (isset($_SESSION['user_id']) && isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3){
                echo "<a href='index.php?controller=workshops&action=show&id=" . $workshop['id_workshop'] . "'><i class='fas fa-eye'></i></a> ";
                echo "<button type='button' class='btn-edit-atelier' data-id='" . $workshop['id_workshop'] . "' title='Modifier'><i class='fas fa-pen'></i></button> ";
                echo "<a href='index.php?controller=workshops&action=delete&id=" . $workshop['id_workshop'] . "' onclick='return confirm(\"Êtes-vous sûr ?\")'><i class='fas fa-trash'></i></a>";
            } 

            // Fermeture correcte de la cellule et de la ligne (à l'intérieur de la boucle)
            echo "</td>";
            // echo "<ul id='workshops-list'></ul>"; // Liste pour ajouter dynamiquement les ateliers
            echo "</tr>";
        }
         // fin du foreach
        endif ?>

        </tbody>
    </table>

    <script>
        form = document.getElementById('form-add-atelier');
        form.addEventListener('submit', async e => {
        e.preventDefault();
    const data = new FormData(form);
    // Envoie vers ton endpoint qui insère l'atelier et renvoie JSON { success: true, workshop: {...} }
    try {
      const response = await fetch("index.php?controller=workshops&action=create", {
        method: 'POST',
        body: data
      });
      const result = await response.json();
        if (result.success) {
            // Ajoute le nouvel atelier à la liste du tableau sans recharger
            

            const tr = document.createElement('tr'); // Crée une nouvelle ligne pour le tableau
            const tbody = document.querySelector('tbody'); //Cible le corps du tableau pour y ajouter la nouvelle ligne
            const workshop = result.workshop; // L'atelier créé renvoyé par le serveur

            tr.id = 'workshop-' + workshop.id_workshop;// Assigne un ID unique à la ligne pour faciliter les manipulations futures
            tr.setAttribute('data-id', workshop.id_workshop); // Attribut personnalisé pour stocker l'ID de l'atelier
            tr.innerHTML = `
            
             <td> ${workshop.id_workshop}  </td>
             <td> ${workshop.title}  </td>
             <td> ${new Date(workshop.event_date).toLocaleDateString('fr-FR')}  </td>
             <td> ${new Date(workshop.event_date).toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}  </td>
             <td> ${workshop.available_places}  /  ${workshop.total_places}  </td>
             <td> ${workshop.category_name ?? 'N/A'}  </td>
              <td>
            

            
            <?php if (!isset($_SESSION['user_id'])) {
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
             if (isset($_SESSION['user_id']) && isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3){
                echo "<a href='index.php?controller=workshops&action=show&id=" . $workshop['id_workshop'] . "'><i class='fas fa-eye'></i></a> ";
                echo "<a href='index.php?controller=workshops&action=edit&id=" . $workshop['id_workshop'] . "'><i class='fas fa-pen'></i></a> ";
                echo "<a href='index.php?controller=workshops&action=delete&id=" . $workshop['id_workshop'] . "' onclick='return confirm(\"Êtes-vous sûr ?\")'><i class='fas fa-trash'></i></a>";
            } ?> 
            
              </td>
            `;


            
            

          tbody.appendChild(tr);
   
            
        } else {
            alert('Erreur lors de l\'ajout de l\'atelier : ' + (result.message || 'Unknown error'));
        }
    } catch (err) {
      console.error('Erreur lors de l\'envoi du formulaire :', err);
      alert('Une erreur est survenue. Vérifiez la console pour plus de détails.');
    }
  });
    </script>
    