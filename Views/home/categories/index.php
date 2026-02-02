<?php $title = "Mes Projets - Liste des Utilisateurs"; ?>

<h1>Liste des Catégories</h1>

<a href="index.php?controller=categories&action=CreateCategory"><button type="button" class="btn btn-primary">Ajouter une Catégorie</button></a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // On boucle dans le tableau $list qui contient la liste des utilisateurs
        foreach ($list as $category) {
        echo "<tr>";
        echo "<td>" . $category->getId_category() . "</td>";
        echo "<td>" . $category->getName() . "</td>";
        echo "<td><a href='index.php?controller=categories&action=ShowCategory&id=" . $category->getId_category() . "'><i class='fas fa-eye'></i></a></td>";
        echo "<td><a href='index.php?controller=categories&action=UpdateCategory&id=" . $category->getId_category() . "'><i class='fas fa-pen'></i></a></td>";
        echo "<td><a href='index.php?controller=categories&action=DeleteCategory&id=" . $category->getId_category() . "'><i class='fas fa-trash'></i></a></td>";
        echo "</tr>";
        }
        ?>
    </tbody>
</table>