<?php
    include "./assets/include/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Slip - Orphanage Care</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./assets/images/logo.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <style>
        
    </style>
</head>
<body>
    <!-- Your existing HTML content goes here -->
    <!-- ... -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <a href="index.html" class="navbar-brand">
        <img src="./assets/images/logo.png" alt="Logo" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Stories</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            </ul>
            <div class="navbar-buttons">
                <a href="./sing-in.php"><button class="btn btn-outline-success me-2">Sign In</button></a>
                <a href="./print-slip.php"><button class="btn btn-outline-success me-2">Print slip</button></a>
                <a href="./donate.php"><button class="btn btn-warning">Donate</button></a>
            </div>
        </div>
    </div>
</nav>
       <div class="container">
        <div class="form-container">
            <h1>Print Orphan Care Slip</h1>
            <div class="form-group">
                <label for="orphanId">Orphan ID or Guardian's Phone Number</label>
                <input type="text" id="orphanId" class="form-control" placeholder="Enter ID or Phone Number">
            </div>
            <p class="popup-notice">Please allow popups for this site from your browser</p>
            <div class="button-group">
                <button id="printBtn" class="btn btn-primary">
                    Print Orphan Care Slip <span class="icon">🖨️</span>
                </button>
                <button id="downloadBtn" class="btn btn-success">
                    Download Slip <span class="icon">⬇️</span>
                </button>
            </div>
        </div>
    </div>
    
    <script>
        const orphanIdInput = document.getElementById('orphanId');
        const printBtn = document.getElementById('printBtn');
        const downloadBtn = document.getElementById('downloadBtn');
    
        orphanIdInput.addEventListener('input', function() {
            const isInputFilled = this.value.trim() !== '';
            printBtn.disabled = !isInputFilled;
            downloadBtn.disabled = !isInputFilled;
        });
    
        printBtn.addEventListener('click', function() {
            const orphanId = orphanIdInput.value;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Orphan Care Slip</title>
                        <style>
                            body { font-family: Arial, sans-serif; }
                            .slip { border: 1px solid #000; padding: 20px; max-width: 500px; margin: 20px auto; }
                            h1 { text-align: center; }
                        </style>
                    </head>
                    <body>
                        <div class="slip">
                            <h1>Orphan Care Slip</h1>
                            <p><strong>Orphan ID / Guardian's Phone:</strong> ${orphanId}</p>
                            <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>
                            <p>This slip confirms the registration of the orphan with the provided ID/Phone number in our care program.</p>
                        </div>
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        });
    
        downloadBtn.addEventListener('click', function() {
            const orphanId = orphanIdInput.value;
            const slipContent = `
    Orphan Care Slip
    ----------------
    Orphan ID / Guardian's Phone: ${orphanId}
    Date: ${new Date().toLocaleDateString()}
    
    This slip confirms the registration of the orphan with the provided ID/Phone number in our care program.
            `;
            
            const blob = new Blob([slipContent], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'OrphanCareSlip.txt';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        });
    </script>
</body>
</html>