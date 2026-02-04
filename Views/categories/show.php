<?php 
// Détails d'une catégorie
?>

<h1>Détails de la Catégorie</h1>
<table class="table">
    
    <tr>
        <th>Nom</th>
        <td><?php echo htmlspecialchars($category->getName()); ?></td>
    </tr>
</table>
<a href="index.php?controller=categories&action=index"><button type="button" class="btn btn-secondary">Retour à la liste des catégories</button></a>