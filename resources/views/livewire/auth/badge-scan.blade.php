<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner QR & Barcode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        h1 {
            margin-top: 20px;
            color: #333;
        }
        #reader {
            width: 400px;
            margin: 20px auto;
        }
        #format-select {
            margin: 10px auto;
            padding: 5px;
            font-size: 1em;
        }
        #result {
            margin-top: 20px;
            font-size: 1.2em;
            color: #007bff;
            word-break: break-all;
        }
        .footer {
            margin-top: 50px;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>

    <h1>Scanner QR & Barcode en direct</h1>

    <select id="format-select">
        <option value="QR_CODE">QR Code</option>
        <option value="BARCODE">Barcodes</option>
    </select>

    <div id="reader"></div>

    <div id="result">Résultat: <span id="output">Aucun</span></div>

    <div class="footer">
        &copy; 2025 Laravel Scanner
    </div>

    <!-- HTML5 QR Code library -->
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        let html5QrcodeScanner;
        let currentFormats = ["QR_CODE", "CODE_128", "CODE_39", "EAN_13", "EAN_8", "UPC_A", "UPC_E"];

        function getFormats(selection) {
            if (selection === "QR_CODE") {
                return ["QR_CODE"];
            } else if (selection === "BARCODE") {
                return ["CODE_128", "CODE_39", "EAN_13", "EAN_8", "UPC_A", "UPC_E"];
            } else {
                return currentFormats;
            }
        }

        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('output').innerText = decodedText;
            console.log(`Code scanné: ${decodedText}`);
        }

        function onScanFailure(error) {
            // ignore scan failures
        }

        function startScanner(formats) {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear().then(() => {
                    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                });
            } else {
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader",
                    {
                        fps: 10,
                        qrbox: 300,
                        formatsToSupport: formats,
                        experimentalFeatures: { useBarCodeDetectorIfSupported: true },
                        videoConstraints: { facingMode: "environment", width: {ideal:1280}, height:{ideal:720} }
                    },
                    false
                );

                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }
        }

        // Start scanner initially
        startScanner(getFormats("QR_CODE"));

        // Listen to dropdown change
        document.getElementById("format-select").addEventListener("change", function() {
            const selected = this.value;
            const formats = getFormats(selected);
            html5QrcodeScanner.clear().then(() => {
                html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                {
                    fps: 10,
                    qrbox: 300,
                    formatsToSupport: formats,
                    experimentalFeatures: { useBarCodeDetectorIfSupported: true },
                    videoConstraints: { facingMode: "environment", width: {ideal:1280}, height:{ideal:720} }
                },
                false
            );

                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            });
        });
    </script>

</body>
</html>

{{-- e0:95:ff:18:15:60 --}}


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Scanner</title>
    <script src="https://unpkg.com/html5-qrcode"></script>

    <style>
        body { 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            font-family: Arial; 
            padding: 10px; 
        }
        #reader {
            width: 100%;
            max-width: 420px;
        }
        #controls {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        button {
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            background: #03624f;
            color: #fff;
            cursor: pointer;
        }
        button:hover { background: #024f3c; }
    </style>
</head>

<body>

<h2>Barcode Scanner</h2>

<div id="reader"></div>

<div id="controls">
    <button onclick="switchCamera()">Switch Camera</button>
    <button onclick="triggerFile()">Scan Image</button>
</div>

<input type="file" id="file-input" accept="image/*" style="display:none">

<p id="result" style="margin-top: 15px; font-size: 18px; font-weight: bold;"></p>

<script>
    let html5QrCode;
    let cameras = [];
    let currentCameraIndex = 0;

    async function startScanner() {
        html5QrCode = new Html5Qrcode("reader");

        cameras = await Html5Qrcode.getCameras();
        if (cameras.length === 0) {
            alert("No camera found");
            return;
        }

        startCamera(cameras[currentCameraIndex].id);
    }

    function startCamera(deviceId) {
        const config = {
            qrbox: { width: 250, height: 150 },
            fps: 30,
            aspectRatio: 1.777,
        };

        html5QrCode.start(
            { deviceId },
            config,
            decodedText => {
                document.getElementById("result").innerHTML = "Scanned: " + decodedText;
            }
        );
    }

    function switchCamera() {
        if (cameras.length <= 1) return alert("Only one camera available");

        html5QrCode.stop().then(() => {
            currentCameraIndex = (currentCameraIndex + 1) % cameras.length;
            startCamera(cameras[currentCameraIndex].id);
        });
    }

    // 🔥 Trigger hidden file input
    function triggerFile() {
        document.getElementById("file-input").click();
    }

    // 🔥 Scan uploaded image
    document.getElementById("file-input").addEventListener("change", function (event) {
        const imageFile = event.target.files[0];
        if (!imageFile) return;

        html5QrCode.stop().then(() => {
            html5QrCode
                .scanFile(imageFile, true) // second param: show the image
                .then(decodedText => {
                    document.getElementById("result").innerHTML = "Scanned: " + decodedText;
                })
                .catch(err => alert("Failed to scan image: " + err));
        });
    });

    startScanner();
</script>

</body>
</html> --}}
