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
    {!! $html !!} <!-- Render the HTML table -->
    <script>
        window.onload = function() {
            window.print(); // Trigger the print dialog
        };
    </script>
</body>
</html>