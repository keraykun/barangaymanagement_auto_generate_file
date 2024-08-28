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
<div class="mb-2">
    <a class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" href="{{ route('admin.residentlist.detail',$resident->id) }}">Back</a>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg flex flex-row gap-5 p-3">
    <section class="">
        @if ($resident->image==='noimage.jpg')
        <div class="w-250 rounded-md">
            <img class="object-contain" src="{{ url('images/noimage.jpg') }}"/>
        </div>
        @else
        <div class="w-20 rounded-md">
            <img class="object-contain" src="{{ url('images/residents/'.$resident->image) }}"/>
        </div>
        @endif
    </section>
    <section class="w-full flex flex-col gap-5">
        @if (Session::has('success'))
            <div class="text-green-600 text-2xl m-3 w-full text-center">
                <p class=""><span class="font-bold">{{ Session::get('success') }} </span></p>
            </div>
            @endif
        <div class="w-full flex items-end justify-end gap-2">
                    {{-- <ul class="flex gap-4 flex-wrap">
                    <li><a href="{{ route('admin.insurance.create',$resident->id) }}" class="py-2 px-3 bg-green-700  hover:bg-green-600 rounded-md text-white shadow-md">Insurance Certificate</a></li> --}}

                        {{-- <li><a href="{{ route('admin.indigency.file',$resident->id) }}" class="py-2 px-3 bg-green-700  hover:bg-green-600 rounded-md text-white shadow-md">Indigency Certificate</a></li>
                        <li><a href="{{ route('admin.business.show',$resident->id) }}" class="py-2 px-3 bg-green-700  hover:bg-green-600 rounded-md text-white shadow-md">Business Clearance</a></li>
                        <li><a href="{{ route('admin.residentlist.show',$resident->id) }}" class="py-2 px-3 bg-green-700  hover:bg-green-600 rounded-md text-white shadow-md">Upload</a></li>
                        <li><a href="{{ route('admin.residentlist.display',$resident->id) }}" class="py-2 px-3 bg-green-700  hover:bg-green-600 rounded-md text-white shadow-md">display</a></li> --}}

                        {{-- <li><a href="" class="py-2 px-3 bg-green-700  hover:bg-green-600 rounded-md text-white shadow-md">Business Certificate</a></li>
                        <li><a href="" class="py-2 px-3 bg-green-700  hover:bg-green-600 rounded-md text-white shadow-md">Residency Certificate</a></li>
                        <li><a href="" class="py-2 px-3 bg-green-700  hover:bg-green-600 rounded-md text-white shadow-md">Blotter Report</a></li>
                    </ul> --}}
                {{-- <a href="{{ route('admin.residentlist.show',$resident->id) }}">
                    <i class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 fa fa-plus"></i>
                </i>
                </a> --}}

                {{-- <label for="fileInput" class="file-label">
                    <i class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 fa fa-plus"></i>
                </label>
                <form action="{{ route('admin.residentlist.upload') }}" method="post" enctype="multipart/form-data">
                    <input type="file" name="docx_file" id="fileInput" accept=".docx" class="hidden" />
                    <input type="hidden" name="resident_id"  value="{{ $resident->id }}">
                    <div id="buttonContainer" class="hidden">
                        @csrf
                        <button type="submit" id="submitButton">Submit</button>
                        <button id="cancelButton">Cancel</button>
                    </div>
                </form>
                @error('docx_file')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror --}}
                {{-- <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Certificates<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button> --}}

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
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
                </div>

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
<div class="relative text-3xl overflow-x-auto shadow-md sm:rounded-lg flex flex-row gap-5 p-3">
    Indigency Certificate
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg flex flex-row gap-5 p-3">
    <div class="text-2xl flex flex-row items-start gap-10 w-full">
     @if ($indigencies->count()>0)
     @foreach ($indigencies as $indigency)
     <a href="{{ route('admin.indigency.format',$indigency->id) }}" class="flex flex-col gap-3 items-center">
        <span>{{ $indigency->issuance_of }}</span>
        <div>
            <i  class="text-8xl fa fa-file-text text-green-700"></i>
        </div>
    </a>
     @endforeach
     @endif

    </div>
</div>

@endsection
