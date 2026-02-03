
<h1>Liste des Utilisateurs</h1>

<a href="index.php?controller=users&action=create"><button type="button" class="btn btn-primary">Ajouter un Utilisateur</button></a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($list as $user) {
        echo "<tr>";
        echo "<td>" . $user['id_user'] . "</td>";
        echo "<td>" . $user['name'] . "</td>";
        echo "<td>" . $user['email'] . "</td>";
        echo "<td>";
        echo "<a href='index.php?controller=users&action=show&id=" . $user['id_user'] . "'><i class='fas fa-eye'></i></a> ";
        echo "<a href='index.php?controller=users&action=edit&id=" . $user['id_user'] . "'><i class='fas fa-pen'></i></a> ";
        echo "<a href='index.php?controller=users&action=delete&id=" . $user['id_user'] . "' onclick='return confirm(\"Êtes-vous sûr ?\")'><i class='fas fa-trash'></i></a>";
        echo "</td>";
        echo "</tr>";
        }
        ?>
    </tbody>
</table>