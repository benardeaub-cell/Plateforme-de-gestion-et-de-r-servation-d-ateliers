<?php 

$title = "Mes Catégories - " . $category->getName();
?>

<article class="row justify-content-center text-center">
    <h1 class="col-12"><?php echo $category->getName(); ?></h1>
    <p>Email: <?php echo $category->getEmail(); ?></p>
</article>
