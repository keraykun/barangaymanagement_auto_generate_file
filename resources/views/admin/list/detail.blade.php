@extends('admin.layouts')
@section('content')

<style>
    input[type="search"]:focus {
        border: 2px solid rgb(19, 150, 95) !important;
    }
    .file-label {
    cursor: pointer;
    display: inline-block;
}

/* Add your styles for the label, such as color, background, etc. */

/* Visually hide the file input */
.hidden {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0;
}
#buttonContainer {
    display: flex;
    gap: 10px;
}


#submitButton {
    background-color: #4caf50;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
#cancelButton{
    background-color: #9b1919;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
</style>
<style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }
    </style>
<div class="mb-2">
    <a class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" href="{{ route('admin.residentlist.index') }}">Back</a>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg flex flex-row gap-5 p-3">
        @if ($resident->image==='noimage.jpg')
        <div class="w-250 rounded-md">
            <img class="object-contain" src="{{ url('images/noimage.jpg') }}"/>
        </div>
        @else
        <div class="w-50 rounded-md">
            <img class="object-contain min-h-[220px]" src="{{ url('images/residents/'.$resident->image) }}"/>
        </div>
        @endif
    <section class="w-full flex flex-col gap-5">
        @if (Session::has('success'))
            <div class="text-green-600 text-2xl m-3 w-full text-center">
                <p class=""><span class="font-bold">{{ Session::get('success') }} </span></p>
            </div>
            @endif
        <div class="w-full flex items-end justify-end gap-2">

                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Certificates<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    @foreach ($files as $file)
                    <li>
                        <a href="{{ route('admin.residentlist.viewfile',['file'=>$file->id,'resident'=>$resident->id]) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white uppercase">{{ $file->name }}</a>
                    </li>
                    @endforeach
                    </ul>
                </div>



                {{-- <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{ route('admin.indigency.file',$resident->id) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Indigency Certificate</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.business.show',$resident->id) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Business Certificate</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.death.show',$resident->id) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Death Certificates</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.loan.show',$resident->id) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Loan Certificates</a>
                    </li>
                    </ul>
                </div> --}}

        </div>
        <hr class="w-full">
        <div class="w-full">

            <ul>
                <li class="flex flex-col">
                    <ul class="flex text-lg my-2">
                        <li class="font-bold" style=" width:200px !important;">Full Name</li>
                        <li class="font-bold" style=" width:64px !important;">:</li>
                        <li class="w-full" style=""> {{ $resident->lastname.' , '.$resident->firstname.' '.$resident->middlename }}</li>
                    </ul>
                    <ul class="flex text-lg my-2">
                        <li class="font-bold" style=" width:200px !important;">Contact</li>
                        <li class="font-bold" style=" width:64px !important;">:</li>
                        <li class="w-full" style="">{{ $resident->contact }}</li>
                    </ul>
                    <ul class="flex text-lg my-2">
                        <li class="font-bold" style=" width:200px !important;">Birthdate</li>
                        <li class="font-bold" style=" width:64px !important;">:</li>
                        <li class="w-full" style="">    {{  date('Y') - date('Y',strtotime($resident->birthdate)).' ( '.date('M d ,Y',strtotime($resident->birthdate)).' ) '}}</li>
                    </ul>
                    <ul class="flex text-lg my-2">
                        <li class="font-bold" style=" width:200px !important;">Gender</li>
                        <li class="font-bold" style=" width:64px !important;">:</li>
                        <li class="w-full" style="">{{ $resident->gender }}</li>
                    </ul>
                    <ul class="flex text-lg my-2">
                        <li class="font-bold" style=" width:200px !important;">Status</li>
                        <li class="font-bold" style=" width:64px !important;">:</li>
                        <li class="w-full" style="">{{ $resident->status }}</li>
                    </ul>
                    <ul class="flex text-lg my-2">
                        <li class="font-bold" style=" width:200px !important;">Address</li>
                        <li class="font-bold" style=" width:64px !important;">:</li>
                        <li class="w-full" style=""> {{ $resident->district->barangay->name.' - '.$resident->district->name.' - '.$resident->district->zone.' - '.$resident->district->address  }} </li>
                    </ul>
                    <ul class="flex text-lg my-2">
                        <li class="font-bold" style=" width:200px !important;">Municipal</li>
                        <li class="font-bold" style=" width:64px !important;">:</li>
                        <li class="w-full" style="">{{ Session::has('barangay')? Str::ucfirst(Session::get('barangay')->municipal->province->name.' , '.Str::ucfirst(Session::get('barangay')->municipal->name)) : ''}}</li>
                    </ul>
                </li>
            </ul>

        </div>
    </section>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg flex flex-row gap-5 p-3">
    <table id="customers">
        <tr>
          <th>Types of Certificates</th>
          <th>O.R Number</th>
          <th>Price</th>
          <th>Transaction Date</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        @foreach ($contents as $content)
        <tr>
            @if ($content->reprint==null)
            <td>{{ $content->file->name }}</td>
            @else
            <td>{{ $content->file->name }} ( Reprinted )</td>
            @endif
            <td>{{ $content->otr }}</td>
            <td>{{ number_format($content->price,2) }}</td>
            <td>{{ date("M d ,Y",strtotime( $content->created_at)) }}</td>
            <td><a href="{{ route('admin.residentlist.showfile',$content->id) }}">View</a></td>
            <td>
                <button data-modal-target="static-modal-profile-reprint-{{ $content->id }}" data-modal-toggle="static-modal-profile-reprint-{{ $content->id }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none btn-sm focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    Reprint
                    </button>
                    <div  id="static-modal-profile-reprint-{{ $content->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-blue-400" style="border: 1px solid blue !important;">
                            <form  action="{{ route('admin.residentlist.reprint',$content->id) }}" method="POST" class="bg-white dark:bg-gray-700">
                                @csrf
                                <div class="p-4 md:p-5 space-y-4 text-center text-2xl">
                                    REPRINT FILE
                                </div>
                                <div class="p-4 md:p-5 space-y-4  text-2xl">
                                 <div class="form-group">
                                    <label for="">File Name</label>
                                    <input type="text" placeholder="file name" value="{{ $content->name }}" name="name" class="form-control">
                                 </div>
                                 <div class="form-group">
                                    <label for="">File Price</label>
                                    <input type="text" placeholder="file name" value="{{ $content->price }}" name="price" class="form-control">
                                 </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-4 md:p-5 dark:border-gray-600">
                                        <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reprint</button>
                                    <button data-modal-hide="static-modal-profile-reprint-{{ $content->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                {{-- <a href="{{ route('admin.residentlist.reprint',$content->id) }}"  class="bg-blue-600 text-white py-2 px-2 rounded-md">Re-Print</a></td> --}}
            <td>
                <button data-modal-target="static-modal-profile-delete-{{ $content->id }}" data-modal-toggle="static-modal-profile-delete-{{ $content->id }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none btn-sm focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                Delete
                </button>
                <div  id="static-modal-profile-delete-{{ $content->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full bg-red-400" style="border: 1px solid red !important;">
                        <div class="bg-white dark:bg-gray-700">
                            <div class="p-4 md:p-5 space-y-4 text-center text-2xl">
                                The file is already in use, are you sure you want to delete this file
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-4 md:p-5 dark:border-gray-600">
                                <form method="POST" action="{{ route('admin.certificate.destroy',$content->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button data-modal-hide="defaultModal" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                </form>
                                <button data-modal-hide="static-modal-profile-delete-{{ $content->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
      </table>
</div>
{{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex flex-row gap-5 p-3">
    <div class="text-2xl flex flex-row items-start gap-10 w-full">
        @if ($resident->allfiles->count()>0)
       @foreach ($resident->allfiles as $file)
        <a href="{{ route('admin.residentlist.display',$file->name) }}" class="flex flex-col gap-3 items-center">
            <span>{{ $file->name }}</span>
            <div>
                <i  class="text-8xl fa fa-file-text text-green-700"></i>
            </div>
        </a>
       @endforeach
        @endif
    </div>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg flex flex-row gap-5 p-3">
    <div class="text-2xl flex flex-row items-start gap-10 w-full">
     @if ($resident->business_count>0)
     <a href="{{ route('admin.business.list',$resident->id) }}" class="flex flex-col gap-3 items-center">
        <span>Business Certificate : {{ $resident->business_count }}</span>
        <div>
            <i  class="text-8xl fa fa-file-text text-green-700"></i>
        </div>
    </a>
     @endif
     @if ($resident->indigency_count>0)
     <a href="{{ route('admin.indigency.list',$resident->id) }}" class="flex flex-col gap-3 items-center">
        <span>Indigency Certificate : {{ $resident->indigency_count }}</span>
        <div>
            <i  class="text-8xl fa fa-file-text text-green-700"></i>
        </div>
    </a>
     @endif
     @if ($resident->death_count>0)
     <a href="{{ route('admin.death.list',$resident->id) }}" class="flex flex-col gap-3 items-center">
        <span>Death Certificate : {{ $resident->death_count }}</span>
        <div>
            <i  class="text-8xl fa fa-file-text text-green-700"></i>
        </div>
    </a>
     @endif
     @if ($resident->loan_count>0)
     <a href="{{ route('admin.loan.list',$resident->id) }}" class="flex flex-col gap-3 items-center">
        <span>Loan Certificate : {{ $resident->loan_count }}</span>
        <div>
            <i  class="text-8xl fa fa-file-text text-green-700"></i>
        </div>
    </a>
     @endif

    </div>
</div> --}}
<script>
document.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('barangayManagement').classList.add('show')
});

document.getElementById('fileInput').addEventListener('change', function () {
    var buttonContainer = document.getElementById('buttonContainer');

    if (this.files.length > 0) {
        var fileName = this.files[0].name;
        var extension = fileName.split('.').pop().toLowerCase();

        if (extension === 'docx') {
            // Show buttons if a valid file is selected
            buttonContainer.classList.remove('hidden');
        } else {
            // Clear the file input and hide buttons if an invalid file is selected
            this.value = '';
            buttonContainer.classList.add('hidden');
            alert('Please select a valid .docx file.');
        }
    } else {
        // Hide buttons if no file is selected
        buttonContainer.classList.add('hidden');
    }
});

document.getElementById('cancelButton').addEventListener('click', function () {
    // Clear the file input and hide buttons
    document.getElementById('fileInput').value = '';
    document.getElementById('buttonContainer').classList.add('hidden');
});

</script>
@endsection
