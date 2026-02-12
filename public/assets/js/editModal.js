// Modal de modification d'atelier
document.addEventListener('DOMContentLoaded', function () {
  const overlay = document.querySelector('.modal-overlay-edit');
  const closeBtn = document.getElementById('closeModalEdit');
  const form = document.getElementById('form-edit-atelier');

  if (!overlay || !form) {
    return;
  }

  function openModal() {
    overlay.classList.add('is-visible');
    overlay.removeAttribute('hidden');
    overlay.setAttribute('aria-hidden', 'false');
  }

  function closeModal() {
    overlay.classList.remove('is-visible');
    overlay.setAttribute('hidden', '');
    overlay.setAttribute('aria-hidden', 'true');
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', closeModal);
  }

  document.addEventListener('click', async function (event) {
    const editBtn = event.target.closest('.btn-edit-atelier');
    if (!editBtn) {
      return;
    }

    const workshopId = editBtn.dataset.id;
    if (!workshopId) {
      return;
    }

    try {
      const response = await fetch('index.php?controller=workshops&action=getWorkshopData&id=' + encodeURIComponent(workshopId));
      const data = await response.json();

      const rawEventDate = data.event_date || '';
      const [datePart = '', timePartRaw = '00:00:00'] = rawEventDate.split(' ');
      const timePart = timePartRaw.slice(0, 5);

      form.elements['id_workshop'].value = data.id_workshop || workshopId;
      form.elements['title'].value = data.title || '';
      form.elements['description'].value = data.description || '';
      form.elements['event_date'].value = datePart;
      form.elements['event_time'].value = timePart;
      form.elements['total_places'].value = data.total_places ?? '';
      form.elements['available_places'].value = data.available_places ?? '';
      form.elements['id_category'].value = data.id_category ?? '';

      openModal();
    } catch (error) {
      console.error('Erreur lors de la récupération des données de l\'atelier :', error);
      alert('Impossible de charger les données de l\'atelier.');
    }
  });

  form.addEventListener('submit', async function (event) {
    event.preventDefault();

    const workshopId = form.elements['id_workshop'].value;
    if (!workshopId) {
      alert('ID atelier introuvable.');
      return;
    }

    const formData = new FormData(form);
    const dateValue = formData.get('event_date');
    const timeValue = formData.get('event_time') || '00:00';
    formData.set('event_date', `${dateValue} ${timeValue}:00`);
    formData.delete('event_time');

    try {
      const response = await fetch('index.php?controller=workshops&action=edit&id=' + encodeURIComponent(workshopId), {
        method: 'POST',
        body: formData
      });

      const data = await response.json();
      if (!data.success) {
        alert('Erreur lors de la mise à jour de l\'atelier : ' + (data.message || 'erreur inconnue'));
        return;
      }

      const row = document.getElementById('workshop-' + workshopId);
      if (row) {
        const cells = row.querySelectorAll('td');
        const selectedCategory = form.elements['id_category'].selectedOptions[0]?.textContent?.trim() || 'N/A';
        const [y, m, d] = String(form.elements['event_date'].value || '').split('-');
        const formattedDate = y && m && d ? `${d}-${m}-${y}` : '';

        if (cells[1]) cells[1].textContent = form.elements['title'].value;
        if (cells[2]) cells[2].textContent = formattedDate;
        if (cells[3]) cells[3].textContent = form.elements['event_time'].value;
        if (cells[4]) cells[4].textContent = `${form.elements['available_places'].value} / ${form.elements['total_places'].value}`;
        if (cells[5]) cells[5].textContent = selectedCategory;
      }

      closeModal();
    } catch (error) {
      console.error('Erreur lors de la mise à jour de l\'atelier :', error);
      alert('Une erreur est survenue pendant la modification.');
    }
  });

  overlay.addEventListener('click', function (event) {
    if (event.target === overlay) {
      closeModal();
    }
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && overlay.classList.contains('is-visible')) {
      closeModal();
    }
  });
});



 
