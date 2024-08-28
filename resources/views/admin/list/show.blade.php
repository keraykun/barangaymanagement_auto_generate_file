<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
        .hide-print {
            display: block;
        }

        @media print {
            .hide-print {
                display: none;
            }
        }
        /* Optional: Add additional styles as needed */
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body style="position: relative;">


    <button data-toggle="modal" data-target="#exampleModal-{{ $resident->id }}" style="color:white; background:#0a7b49; padding:15px 30px; margin:5px; cursor: pointer; position: sticky; top:50px; bottom:0; float: right; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">Save to Database</button>
    <div id="docxContent" style="padding: 15px; background:white;" contenteditable="true"> {!! $docxContent !!}</div>
    <input type="hidden" id="file" value="{{ $file->name }}">
    <input type="hidden" id="resident" value="{{ $resident->id }}">

        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{ $resident->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">ARE YOU SURE YOU WANT TO PRINT THIS?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" >
                        <li class="list-group-item" style=" text-align:start;"><span style="margin-right:10px;"><b>FILE :</b> </span><span id="fileID" data-id="{{ $file->id }}">{{ $file->name }}</span></li>
                        <li class="list-group-item" style=" text-align:start; cursor: pointer"><span style="margin-right:10px;"><b>O.R # :</b> </span><span id="fileOtr" contenteditable="true" style="border: none !important; outline:0 !important">{{ $file->otr }}</span></li>
                        <li class="list-group-item" style=" text-align:start;"><span style="margin-right:10px;"><b>PRICE :</b> </span><span id="filePrice" style="border: none !important; outline:0 !important">{{ number_format($file->price,2) }}</span> Peso</li>
                        <li class="list-group-item" style=" text-align:start;"><span style="margin-right:10px;"><b>ORDERD BY :</b> </span><span >{{ $resident->lastname }} , {{ $resident->firstname }} {{ $resident->middlename }}</span></li>
                        <li class="list-group-item" style=" text-align:start;"><span style="margin-right:10px;"><b>PREPARED BY :</b> </span><span id="fileprepared" data-id="{{ auth()->user()->id }}">{{ auth()->user()->name }}</span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="createButton" class="btn btn-primary">Save and View PDF</button>
                </div>
            </div>
            </div>
        </div>

        <script>
            window.onkeydown = function(event) {
                // Check if CTRL + P is pressed
                if (event.ctrlKey && event.keyCode === 80) {
                    // Hide the button
                    document.querySelector('button').classList.add('hide-print');
                }
            };

            $(document).ready(function(){
                $('#createButton').click(function(e){
                    e.preventDefault();
                    var formData = new FormData();
                    var ResidentID = $('#resident').val()
                    formData.append('content', $('#docxContent').html());
                    formData.append('file',$('#file').val());
                    formData.append('otr',$('#fileOtr').text());
                    formData.append('prepared',$('#fileprepared').data('id'));
                    formData.append('price',$('#filePrice').text());
                    formData.append('resident', ResidentID);
                    formData.append('fileID', $('#fileID').data('id'));
                    $.ajax({
                        url: "{{ route('admin.residentlist.storefile') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:formData,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            console.log(response)
                            if (response.success) {
                                var resi = response.resident
                                var redirectToPage = "{{ route('admin.residentlist.showfile', '') }}/" + response.file;
                                sessionStorage.setItem('success', 'true');
                                window.location.href = redirectToPage;
                            }
                        },
                        error: function(xhr, status, error){
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
</body>
</html>
