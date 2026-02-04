
<h1>Ajouter un Atelier</h1>
<form action="#" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" name="description">
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" name="event_date" value="<?php echo htmlspecialchars($_POST['event_date'] ?? ''); ?>">
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="time" name="event_time" value="<?php echo htmlspecialchars($_POST['event_time'] ?? ''); ?>">
    </div>

    <!-- Sélection de la catégorie (passer $categories depuis le contrôleur) -->
    <div class="mb-3">
        <label for="id_category" class="form-label">Catégorie</label>
        <?php if (!empty($categories)): ?>
            <select name="id_category" class="form-control">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat['id_category']); ?>" <?php echo (isset($_POST['id_category']) && $_POST['id_category']==$cat['id_category']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php else: ?>
            <!-- fallback hidden pour éviter l'erreur si le contrôleur n'envoie rien -->
            <input type="hidden" name="id_category" value="<?php echo htmlspecialchars($_POST['id_category'] ?? ''); ?>">
            <p class="text-muted">Aucune catégorie disponible.</p>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="total_places" class="form-label">Total Places</label>
        <input type="text" class="form-control" id="total_places" name="total_places">
    </div>

    <div class="mb-3">
        <label for="available_places" class="form-label">Available Places</label>
        <input type="text" class="form-control" id="available_places" name="available_places">
    </div>

    <input type="text" hidden id="hidden" name="hidden">
    <button type="submit" class="btn btn-primary">Ajouter</button>
