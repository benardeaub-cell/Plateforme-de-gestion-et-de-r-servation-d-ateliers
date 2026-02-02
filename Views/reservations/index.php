<?php $title = "Mes Réservations - Liste des Réservations"; ?>

<h1>Liste des Réservations</h1>

<a href="index.php?controller=reservations&action=CreateReservation"><button type="button" class="btn btn-primary">Ajouter une Réservation</button></a>

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
        foreach ($list as $reservation) {
        echo "<tr>";
        echo "<td>" . $reservation->getId() . "</td>";
        echo "<td>" . $reservation->getUser_name() . "</td>";
        echo "<td>" . $reservation->getWorkshop_name() . "</td>";
        echo "<td><a href='index.php?controller=reservations&action=ShowReservation&id=" . $reservation->getId() . "'><i class='fas fa-eye'></i></a></td>";
        echo "<td><a href='index.php?controller=reservations&action=UpdateReservation&id=" . $reservation->getId() . "'><i class='fas fa-pen'></i></a></td>";
        echo "<td><a href='index.php?controller=reservations&action=DeleteReservation&id=" . $reservation->getId() . "'><i class='fas fa-trash'></i></a></td>";
        echo "</tr>";
        }
        ?>
    </tbody>
</table>