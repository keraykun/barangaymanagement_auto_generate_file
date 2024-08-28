<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Set width and margin for A4 size */
        body {
            hyphens: auto;
            width: 30cm;
            margin: 0 auto;
            text-align: center !important;
            line-height: 1.5; /* Adjust line height as needed */
            background: linear-gradient(to bottom right, #55566a, #282834);
        }
        @page {
            size: A4;
            margin: 0 !important;
        }
        /* Optional: Add additional styles as needed */
    </style>
</head>
<body>
   <div style="padding: 15px; background:white;" contenteditable="true"> {!! $docxContent !!}</div>
</body>
</html>
