const warningBox = document.getElementById('warningBox');
    const warningBtn = document.getElementById('warningBtn');
    const closeWarning = document.getElementById('closeWarning');

    let autoHideTimer;

    function showWarning(auto = false) {
        warningBox.style.display = 'block';

        if (auto) {
            clearTimeout(autoHideTimer);
            autoHideTimer = setTimeout(() => {
                warningBox.style.display = 'none';
            }, 60000); // 1 minute
        }
    }

    function hideWarning() {
        warningBox.style.display = 'none';
        clearTimeout(autoHideTimer);
    }

    // Auto show on page load
    window.addEventListener('load', () => {
        showWarning(true);
    });

    // Toggle on icon click
    warningBtn.addEventListener('click', () => {
        if (warningBox.style.display === 'none' || warningBox.style.display === '') {
            showWarning(false);
        } else {
            hideWarning();
        }
    });

    // Close button
    closeWarning.addEventListener('click', hideWarning);