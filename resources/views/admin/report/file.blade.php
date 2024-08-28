<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>
<body>
    <div class="flex gap-3" id="printData">
        <div class="card mt-3 flex-1">
            <div class="card-body flex mb-5 items-center flex-col text-2xl">
                <article class="flex flex-col text-center">
                <span class="font-bold">Complaint Name  </span>
                <span style="font-weight: normal !important;"> {{ $report->name }}</span>
                </article>
                  <article class="flex flex-col text-center">
                <span class="font-bold">Involved Name </span>
                <span>{{ $report->resident_name }}</span>
                </article>
                  <article class="flex flex-col text-center">
                <span class="font-bold">Action </span>
                <span>{{ $report->actions }}</span>
                </article>
                  <article class="flex flex-col text-center">
                <span class="font-bold">Statement </span>
                <span> {{ $report->Statement }}</span>
                </article>
            </div>
            <div class="card-body items-center flex justify-evenly flex-row text-lg">
                <article class="flex flex-col">
                    <span class="mr-2">{{ $report->date_reported }}</span>
                    <span class="font-bold">Date Reported</span>
                </article>
                <article class="flex flex-col">
                    <span class="mr-2">{{ $report->date_incident }}</span>
                    <span class="font-bold">Date Incendent</span>
                    </article>
                <article class="flex flex-col">
                <span class="mr-2">{{ $report->date_recorded }}</span>
                <span class="font-bold">Date Recorded</span>
                </article>
            </div>
        </div>
    </div>
    </div>
</div>
</body>
</html>

