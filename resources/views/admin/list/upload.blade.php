<!DOCTYPE html>
<html>
<head>
    <title>Display Word Document</title>
</head>
<style>
       body, h1, h2, h3, p, div {
        margin: 0;
        padding: 0;
    }

    body {
        font-size: 16px; /* Set a base font size */
        line-height: 1.5; /* Adjust the line height as needed */
    }
</style>
<body>

   <div contenteditable="true" style="width:800px; padding:10px; overflow-x:scroll;">
    {!! $htmlContent !!}
   </div>

</body>
</html>
