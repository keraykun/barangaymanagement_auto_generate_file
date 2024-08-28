<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="{{ public_path('css/pdf.css') }}" rel="stylesheet"> --}}
    <title>Document</title>
    <style>
        table, th, td {
            border: none;
          /* border: 1px solid; */
        }
        table{
            border-collapse: collapse;
            width: 100%;
            font-family: sans-serif;
        }
        </style>
</head>
<body>
    <table>
        <tr>
          <th style="width: 250px; padding:0px;">
            @if ($logo->name)
            <img src="images/logos/{{ $logo->name }}" style="width: 200px; height:200px;" alt="Your Image">
            @else
            <img src="images/nologo.jpg" style="width: 250px; height:150px;" alt="Your Image">
            @endif
          </th>
          <th>
            <div style="width: 600px;">
                <p><span style="font-weight: normal;"> Republic of the Philippines </span><br>
                <span style="font-weight: normal;">  Province of {{ $resident->district->barangay->municipal->province->name }} Municipality of {{ $resident->district->barangay->municipal->name }}</span><br>
                 BARANGAY {{ Str::upper($resident->district->barangay->name) }}</p>
            </div>
          </th>
        </tr>
        <tr>
            <th colspan="2"><span style="text-decoration: underline;">OFFICE OF THE BARANGAY CHAIRMAN</span></th></th>
        </tr>
        <tr>
            <th colspan="2" style="height: 50px;"></th>
        </tr>
        tr>
            <th colspan="2"><span style="font-size:1.5rem;">CERTIFICATE OF INDEGENCY</span></th>
        </tr>
      </table>
    {{-- <div>
        <section style="display: flex;">
         <div>
           adsad
         </div>
         <div class="div-2">
            Republic of the PhilippinesProvince of Surigao del SurMunicipality of Barobo
            BARANGAY CAUSWAGAN
         </div>
        </section>
    </div> --}}
</body>
</html>
