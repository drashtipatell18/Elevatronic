<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Print Mantenimiento en Revisión</title>
    <style>
        /* Add any necessary styles for the table here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        media print {
            body * {
                visibility: hidden; /* Hide everything */
            }
            #print-content, #print-content * {
                visibility: visible; /* Show only the print content */
            }
            #print-content {
                position: absolute; /* Position it for printing */
                left: 0;
                top: 0;
            }
        }
        .loader-circle {
            border: 8px solid rgba(128, 128, 128, 0.5);
            /* Grey border */
            border-top: 8px solid #F8592E;
            /* Change this color as needed */
            border-radius: 50%;
            width: 50px;
            /* Size of the loader */
            height: 50px;
            /* Size of the loader */
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div id="loader"
        style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; background: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 5px;">
        <div class="loader-circle"></div>
    </div> <!-- Loader element -->
    {!! $html !!} <!-- Render the first 100 characters of the HTML table -->
    <div id="print-content"></div> <!-- Container for loaded chunks -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let totalChunks = {{ $totalChunks }};
        let chunkSize = {{ $chunkSize }};
        let currentChunk = 1;

        // Function to load the next chunk via AJAX
        function loadNextChunk() {
            if (currentChunk < totalChunks) {
                $("#loader").show(); // Show loader
                fetch(`/load-chunk?chunk=${currentChunk}&chunkSize=${chunkSize}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('print-content').innerHTML += html; // Append new chunk
                        currentChunk++;

                        // Recursively load the next chunk
                        loadNextChunk();
                    })
                    .catch(error => console.error('Error loading chunk:', error));
            } else {
                $("#loader").hide(); // Hide loader after print dialog is closed
                setTimeout(() => window.print(), 100); // Delay print dialog to ensure loader is hidden
            }
        }

        // Load the next chunk after the page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadNextChunk(); // Start loading the chunks
        });
    </script>
</body>

</html>
