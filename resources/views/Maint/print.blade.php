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
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    {!! substr($html, 0, 1100000) !!} <!-- Render the first 100 characters of the HTML table -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Length of HTML: " + document.body.innerHTML.length); // Log the length of the HTML content
            window.print(); // Trigger the print dialog after all data is loaded
        });
    </script>
</body>
</html>