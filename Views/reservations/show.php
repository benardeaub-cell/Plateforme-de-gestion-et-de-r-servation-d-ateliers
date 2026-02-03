

<article class="row justify-content-center text-center">
    <h1 class="col-12">Réservation #<?php echo $reservation->getId(); ?></h1>
    <p>Date: <?php echo $reservation->getDate(); ?></p>
    <p>Utilisateur: <?php echo $reservation->getUser_name(); ?></p>
    <p>Atelier: <?php echo $reservation->getWorkshop_name(); ?></p>
   
</article>
