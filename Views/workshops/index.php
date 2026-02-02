<?php $title = "Mes Projets - Liste des Utilisateurs"; ?>

<h1>Liste des Utilisateurs</h1>

<a href="index.php?controller=users&action=CreateUser"><button type="button" class="btn btn-primary">Ajouter un Utilisateur</button></a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // On boucle dans le tableau $list qui contient la liste des utilisateurs
        foreach ($list as $user) {
        echo "<tr>";
        echo "<td>" . $user->getId_user() . "</td>";
        echo "<td>" . $user->getName() . "</td>";
        echo "<td>" . $user->getEmail() . "</td>";
        echo "<td><a href='index.php?controller=users&action=ShowUser&id=" . $user->getId_user() . "'><i class='fas fa-eye'></i></a></td>";
        echo "<td><a href='index.php?controller=users&action=UpdateUser&id=" . $user->getId_user() . "'><i class='fas fa-pen'></i></a></td>";
        echo "<td><a href='index.php?controller=users&action=DeleteUser&id=" . $user->getId_user() . "'><i class='fas fa-trash'></i></a></td>";
        echo "</tr>";
        }
        ?>
    </tbody>
</table>