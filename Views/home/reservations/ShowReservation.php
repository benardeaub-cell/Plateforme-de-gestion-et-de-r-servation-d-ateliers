<?php 

$title = "Mes Projets - " . $user->getName();
?>

<article class="row justify-content-center text-center">
    <h1 class="col-12"><?php echo $user->getName(); ?></h1>
    <p>Email: <?php echo $user->getEmail(); ?></p>
</article>
