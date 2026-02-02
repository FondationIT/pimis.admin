const modalmsg = document.getElementById('QrModalMessage');
let scanAnimationId = null;
const scanBtn = document.getElementById('scanBtn');
const codeBtn = document.getElementById('codeBtn');
const scanSection = document.getElementById('scanSection');
const codeSection = document.getElementById('codeSection');
const video = document.getElementById('qrVideo');
const submitCode = document.getElementById('submitCode');
const input = document.getElementById('codeInput');

let scanning = false;

const qrModal = new bootstrap.Modal(
    document.getElementById('qrAuthModal'),
    {
        backdrop: 'static',
        keyboard: false,
        focus: false   // 🔥 THIS FIXES IT
    }
);

qrModal.show();

submitCode.onclick = () => {
    const code = input.value.trim();

    if(!code){
        modalmsg.textContent = "Le numero de la carte est requis.";
        modalmsg.classList.add('show');
        return
    }
    const url = `agent-card-bar-validation/${code}`;
    

    fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        }
    })
    .then(res => res.json())
    .then(data => {
        
        const modalmsg = document.getElementById('QrModalMessage');

        if (data.status === 'success') {
            modalmsg.textContent = "Nous vous souhaitons une belle journée de travail, restez bénis.";
            modalmsg.classList.remove('alert-danger');
            modalmsg.classList.add('alert-success');
            modalmsg.classList.add('show');

            setTimeout(() => {
                const modalEl = document.getElementById('qrAuthModal');
                const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.hide();
            }, 3000);
            
        } else {
            modalmsg.textContent = data.message ?? 'Utilisateur Invalide';
            modalmsg.classList.add('show');
        }
    })
    .catch(err => {
        modalmsg.textContent = err.message ?? 'script error sending';
        modalmsg.classList.add('show');
        console.error(err);
    });
}

// ❌ No paste
input.addEventListener('paste', e => e.preventDefault());

// ❌ No drag & drop
input.addEventListener('drop', e => e.preventDefault());

// ❌ Block autofill injection (Chrome)
input.addEventListener('input', e => {
    if (e.inputType === 'insertFromPaste' ||
        e.inputType === 'insertFromDrop' ||
        e.inputType === 'insertReplacementText') {
        e.target.value = '';
    }
});

scanBtn.onclick = () => {
    scanBtn.classList.add('active', 'btn-primary');
    scanBtn.classList.remove('btn-outline-primary');

    codeBtn.classList.remove('active', 'btn-primary');
    codeBtn.classList.add('btn-outline-primary');

    scanSection.classList.remove('d-none');
    codeSection.classList.add('d-none');

    video.style.display = 'block'; // 👈 restore video
    startCamera();
};


codeBtn.onclick = () => {
    codeBtn.classList.add('active', 'btn-primary');
    codeBtn.classList.remove('btn-outline-primary');

    scanBtn.classList.remove('active', 'btn-primary');
    scanBtn.classList.add('btn-outline-primary');

    scanSection.classList.add('d-none');
    codeSection.classList.remove('d-none');

    stopCamera();

    // 🔥 IMPORTANT
    video.pause();
    video.srcObject = null;
    video.style.display = 'none';

    setTimeout(() => {
        const input = document.getElementById('codeInput');
        input.removeAttribute('disabled');
        input.focus();
    }, 150);
};

// CAMERA
function startCamera() {
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(stream => {
            video.srcObject = stream;
            video.setAttribute("playsinline", true);
            video.play();

            scanning = true;

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            video.addEventListener('loadedmetadata', () => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                const scan = () => {
                    if (!scanning || !video.srcObject) return;

                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

                    const qrCode = jsQR(imageData.data, canvas.width, canvas.height);

                    if (qrCode) {
                        // send QR but do NOT stop scanning on failure
                        sendQrValue(qrCode.data);
                    }

                    scanAnimationId = requestAnimationFrame(scan); // always continue scanning
                };

                scanAnimationId = requestAnimationFrame(scan);
            });
        })
        .catch(err => {
            console.error(err);
            modalmsg.textContent = 'Cannot access camera';
            modalmsg.classList.add('show');
        });
}

function sendQrValue(qrValue) {
    const isQrValid = qrValue.startsWith('https://admin.pimis.org/api/fp/card-member/');

    if (!isQrValid) {
        modalmsg.textContent = "Le produit scanné n'appartient pas à la Fondation Panzi";
        modalmsg.classList.add('show');
        // keep scanning, do not stop
        return;
    }

    // Valid QR: stop scanning and send to backend
    scanning = false; // stop further scanning
    stopCamera();

    qrValue = qrValue.replace('https://admin.pimis.org/api/fp/card-member/', 'agent-card-validation/');

    fetch(qrValue, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        }
    })
    .then(res => res.json())
    .then(data => {
        
        const modalmsg = document.getElementById('QrModalMessage');

        if (data.status === 'success') {
            modalmsg.textContent = "Nous vous souhaitons une belle journée de travail, restez bénis.";
            modalmsg.classList.remove('alert-danger');
            modalmsg.classList.add('alert-success');
            modalmsg.classList.add('show');

            setTimeout(() => {
                const modalEl = document.getElementById('qrAuthModal');
                const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.hide();
            }, 3000);
            
        } else {
            modalmsg.textContent = data.message ?? 'Utilisateur Invalide';
            modalmsg.classList.add('show');
        }
    })
    .catch(err => {
        modalmsg.textContent = err.message ?? 'script error sending';
        modalmsg.classList.add('show');
        console.error(err);
    });
}


function stopCamera() {
    scanning = false;

    if (scanAnimationId) {
        cancelAnimationFrame(scanAnimationId);
        scanAnimationId = null;
    }

    if (video.srcObject) {
        video.srcObject.getTracks().forEach(track => track.stop());
        video.srcObject = null;
    }
}



