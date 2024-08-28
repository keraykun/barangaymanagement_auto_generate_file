@extends('layout')
@section('content')
<style>
    .province-list{
        color:white; background-color: #00b712;
        background-image: linear-gradient(315deg, #00b712 0%, #51b924 74%);
        padding: 5px 20px;
        border-radius: 10px;
        cursor: pointer;
        margin: 15px 0px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;

        width: 100%;
        font-size: 2rem;
        border: 0.1px solid rgb(26, 155, 26);
    }
    .province-hover:hover{
        transform: scale(1.120);
        transition: 200ms ease-in;
    }

    .province-add{
        padding:20px; background:green; border-radius:50%; font-size:2rem;
        color:white; background-color: #00b712;
        background-image: linear-gradient(315deg, #00b712 0%, #51b924 74%);
        box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
        border: 0.1px solid rgb(26, 155, 26);
        transition: 200ms ease-in;
        cursor: pointer;
    }

    .province-back{
        outline: 0;
        padding:20px; background:green; border-radius:50%; font-size:2rem;
        color:white; background-color: #00b712;
        background-image: linear-gradient(315deg, #403677 0%, #44bed1 74%);
        box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
        border: 0.1px solid rgb(26, 155, 26);
        transition: 200ms ease-in;
        cursor: pointer;
    }

    .province-add:hover{
        transform: scale(1.120);
        color:white; background-color: #00b712;
        background-image: linear-gradient(315deg, #00b712 0%, #5aca2a 74%);
    }

    .province-edit{
        padding:10px; background:green; border-radius:50%; font-size:1rem;
        color:white; background-color: #00b712;
        background-image: linear-gradient(315deg, #1b1c7a 0%, #66b5e2 74%);
        box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
        border: 0.1px solid rgb(26, 155, 26);
        transition: 200ms ease-in;
        cursor: pointer;
    }

    .barangay-choose{
        font-weight: bold;
        color: #17411a;
        text-shadow: 2px 7px 5px rgba(0,0,0,0.3),
    0px -4px 10px rgba(255,255,255,0.3);
    }
</style>
<main id="mainbefore" class="relative min-w-xl min-full flex flex-row justify-center h-screen items-stretch">
    <section class="flex items-center justify-center flex-1 bg-[url('/public/images/blob2.png')] bg-cover bg-no-repeat bg-center">
        {{-- <img src="{{ asset('images/sagnu.png') }}" style="position: absolute ; opacity: 0.3;" alt=""> --}}
        <div style="z-index: 1; display:flex; justify-content:center; align-items:center; flex-direction:column">

            @php
            if(Session::has('success')){
                echo '<h1 style="color:red; font-size:1.2rem; padding:5px 10px; background:white; border-radius:10px;">'.Session::get('success').'</h1>';
            }
           @endphp

            <section style="display:flex; flex-direction:column; flex-wrap:wrap; justify-content:center; align-items:center;">
              <article class="barangay-choose" style="font-size: 2rem;">Province of {{ Str::ucfirst($barangays->province->name ) }}</article>
              <article class="barangay-choose" style="font-size: 2rem;">Municipal of {{ Str::ucfirst($barangays->name) }}</article>
              <article class="flex justify-between items-center gap-2">
                {{-- <div>
                    <a class="bg-green-700 p-4 text-white" href="{{ route('admin.province.show',$barangays->province_id)}}"><i class="fa fa-arrow-left"></i></a>
                </div> --}}
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white text-2xl  bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300   px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                    Select Barangay
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <div>
                    @if (auth()->user()->role=='admin')
                    <form method="GET" class="bg-green-700 p-[14px]" action="{{ route('admin.barangay.create') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="province_name" value="{{ $barangays->province->name  }}">
                        <input type="hidden" name="municipal_name" value="{{ $barangays->name  }}">
                        <input type="hidden" name="municipal_id" value="{{ $barangays->id }}">
                        @if (auth()->user()->role=='admin')
                        <button type="submit"><i class="fa fa-add text-white"></i></button>
                        @endif
                     </form>
                    @endif
                </div>
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100  shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        @foreach ($barangays->barangays as $barangay)
                        <li class="flex justify-between items-center pr-3">
                        <a href="{{ route('admin.barangay.show',$barangay->id) }}" class="block px-4 py-2 text-lg hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <span>{{ $barangay->name }}</span>
                        @if (auth()->user()->role=='admin')
                        <a href="{{ route('admin.barangay.show',$barangay->id) }}"><i class="fa fa-pencil"></i></a>
                        @endif
                        </a>
                    </li>
                    @endforeach
                    </ul>
                </div>
               </article>
              {{-- @foreach ($barangays->barangays as $barangay)
                    <div class="flex justify-center items-center gap-2 flex-column province-hover">
                        <a href="{{ route('admin.barangay.show',$barangay->id) }}" class="province-list">{{ $barangay->name }}</a>
                        @if (auth()->user()->role=='admin')
                        <a href="{{ route('admin.barangay.edit',$barangay->id) }}"><i class="fa fa-pencil province-edit"></i></a>
                        @endif
                    </div>
                 @endforeach
                 <form method="GET" action="{{ route('admin.barangay.create') }}">
                    <a href="{{ route('admin.province.show',$barangays->province_id)}}"><i class="fa fa-arrow-left province-back"></i></a>
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="province_name" value="{{ $barangays->province->name  }}">
                    <input type="hidden" name="municipal_name" value="{{ $barangays->name  }}">
                    <input type="hidden" name="municipal_id" value="{{ $barangays->id }}">
                    @if (auth()->user()->role=='admin')
                    <button type="submit"><i class="fa fa-add province-add"></i></button>
                    @endif
                 </form> --}}

            </section>
        </div>
    </section>

</main>
@endsection
