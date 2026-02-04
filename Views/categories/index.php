<h1>Liste des Catégories</h1>

<?php 
// Bouton pour ajouter une nouvelle catégorie si connecté en admin 
if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3):
?>
<a href="index.php?controller=categories&action=create"><button type="button" class="btn btn-primary">Ajouter une Catégorie</button></a>
<?php
endif;
?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // On boucle dans le tableau $list qui contient la liste des catégories (arrays)
        foreach ($list as $category) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($category['id_category']) . "</td>";
            echo "<td>" . htmlspecialchars($category['name']) . "</td>";
            echo "<td>";?>
            <?php 
            // Affichage des actions uniquement si connecté en admin
            if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3):
            ?>

            <a href='index.php?controller=categories&action=show&id=<?php echo urlencode($category['id_category']); ?>'><i class='fas fa-eye'></i></a>
            <a href='index.php?controller=categories&action=edit&id=<?php echo urlencode($category['id_category']); ?>'><i class='fas fa-pen'></i></a>
            <a href='index.php?controller=categories&action=delete&id=<?php echo urlencode($category['id_category']); ?>' onclick='return confirm("Êtes-vous sûr ?")'><i class='fas fa-trash'></i></a>
            <?php
            endif;

            ?>
            
            <?php
            // Affichage d'un bouton vers la liste des workshops de la catégorie
            ?>
            <a href='index.php?controller=workshops&action=findByCategory&id=<?php echo urlencode($category['id_category']); ?>'><i class='fas fa-list'></i></a>
            <?php
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>