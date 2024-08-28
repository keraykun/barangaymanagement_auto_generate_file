@extends('admin.layouts')
@section('content')

<style>
    input[type="search"]:focus {
        border: 2px solid rgb(19, 150, 95) !important;
    }
</style>
<div class="mb-2">
    <a class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" href="{{ route('admin.resident.show',$resident->district->id) }}">Back</a>
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
        <div class="w-full">
            {{-- <ul class="flex gap-4 flex-wrap">

                <li><a href="{{ route('admin.indigency.file',$resident->id) }}" class="py-2 px-3 bg-green-700  hover:bg-green-600 rounded-md text-white shadow-md">Indigency Certificate</a></li>
                <li><a href="{{ route('admin.business.show',$resident->id) }}" class="py-2 px-3 bg-green-700  hover:bg-green-600 rounded-md text-white shadow-md">Business Clearance</a></li>

            </ul> --}}
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
    <div class="text-2xl flex flex-row items-start gap-10 w-full">
     @if ($resident->business_count>0)
     <a href="{{ route('admin.business.list') }}" class="flex flex-col gap-3 items-center">
        <span>Business Certificate : {{ $resident->business_count }}</span>
        <div>
            <i  class="text-8xl fa fa-file-text text-green-700"></i>
        </div>
    </a>
     @endif
     @if ($resident->indigency_count>0)
     <a href="{{ route('admin.indigency.list') }}" class="flex flex-col gap-3 items-center">
        <span>Indigency Certificate : {{ $resident->indigency_count }}</span>
        <div>
            <i  class="text-8xl fa fa-file-text text-green-700"></i>
        </div>
    </a>
     @endif

    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('barangayManagement').classList.add('show')
});
</script>
@endsection
