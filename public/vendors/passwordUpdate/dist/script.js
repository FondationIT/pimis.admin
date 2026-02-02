document.addEventListener("DOMContentLoaded", function () {

  const modalEl = document.getElementById('forcePasswordModal');
  const modalmsg = document.getElementById('ModalMessage');
  const modal = new bootstrap.Modal(modalEl, {
    backdrop: 'static',
    keyboard: false
  });

  modal.show();

  // Prevent manual removal via inspector
  const observer = new MutationObserver(() => {
    if (!document.body.contains(modalEl)) {
      location.reload();
    }
  });

  observer.observe(document.body, { childList: true });

  // Handle submit
  document.getElementById('passwordForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const p1 = password.value;
    const p2 = password_confirmation.value;

    if (p1 !== p2) {
        modalmsg.textContent = 'Passwords do not match';
        modalmsg.classList.add('show');
        return;
    }

    // Example AJAX (Laravel-ready)
    fetch('/password-update', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ 
        password: p1
    })
    })
    .then(async res => {
    let data;
    try {
        data = await res.json();
    } catch (e) {
        const text = await res.text();
        console.error('Server returned non-JSON:', text);
        throw e;
    }

    if (data.status === 'success') {
        document.getElementById('hard-lock-overlay').remove();
        modal.hide();

    } else {
        modalmsg.textContent = data.message || 'An error occurred. Please try again.';
        modalmsg.classList.add('show');
    }
    })
    .catch(err => console.error(err));

  });

});