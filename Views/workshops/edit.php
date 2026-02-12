
<h1>Modification d'un Atelier</h1>
<?php
if(!empty($erreur)){
?>  
<div class="alert alert-danger" role="alert">
  <?php echo $erreur; ?>
</div>
<?php
}
?>
<form action="#" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($workshop['title']); ?>">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" name="description" value="<?php echo htmlspecialchars($workshop['description']); ?>"> 
    </div>

    <div class="mb-3">
    <label for="event_date" class="form-label">Date et Heure</label>
    <input type="datetime-local" class="form-control" id="event_date" name="event_date" value="<?php echo date('Y-m-d\TH:i', strtotime($workshop['event_date'])); ?>" required> 
</div>

    <div class="mb-3">
        <label for="total_places" class="form-label">Total Places</label>
        <input type="number" class="form-control" id="total_places" name="total_places" value="<?php echo htmlspecialchars($workshop['total_places']); ?>"> 
    </div>

    <div class="mb-3">
        <label for="available_places" class="form-label">Available Places</label>
        <input type="number" class="form-control" id="available_places" name="available_places" value="<?php echo htmlspecialchars($workshop['available_places']); ?>"> 
    </div>

    <div class="mb-3">
        <label for="id_category" class="form-label">Category</label>
        <select class="form-control" id="id_category" name="id_category">
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category['id_category']); ?>" <?php echo $category['id_category'] == $workshop['id_category'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>


