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
        transition: 200ms ease-in;
        width: 100%;
        font-size: 2rem;
        border: 0.1px solid rgb(26, 155, 26);
    }
    .province-list:hover{
        transform: scale(1.120);
        color:white; background-color: #00b712;
        background-image: linear-gradient(315deg, #00b712 0%, #5aca2a 74%);
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

    .province-add:hover{
        transform: scale(1.120);
        color:white; background-color: #00b712;
        background-image: linear-gradient(315deg, #00b712 0%, #5aca2a 74%);
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
        <div style="z-index: 1; display:flex; justify-content:center; align-items:center;">
            <section style="display:flex; flex-direction:column; flex-wrap:wrap; justify-content:center; align-items:center;">
              <article class="barangay-choose" style="font-size: 2rem;">Edit Province</article>
              <div class="w-full">
                <form method="POST" action="{{ route('admin.province.update',$province->id) }}" class="relative bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="absolute right-0 top-0 mr-2 mt-2">
                        <i data-modal-target="defaultModal" data-modal-toggle="defaultModal"  class="fa fa-trash px-2 rounded-full  text-lg cursor-pointer text-red-700"></i>
                    </div>

                    @csrf
                    @method('PATCH')
                    @php
                        if(Session::has('success')){
                            echo '<h1 style="color:green; font-size:1.2rem;">'. Session::get('success').'</h1>';
                        }
                    @endphp

                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      Province Name
                    </label>
                    <input name="name" value="{{ $province->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"   id="username" type="text" placeholder="Ex. Bukidnon">
                    <small>@error('name') <p class="bg-red-500 text-white p-1">{{ $message }}</p> @enderror</small>
                </div>
                  {{-- <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      Province Code
                    </label>
                    <input name="code"  value="{{ $province->code }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  id="username" type="text" placeholder="Ex. 101300000">
                    <small>@error('code') <p class="bg-red-500 text-white p-1">{{ $message }}</p> @enderror</small>
                </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      Region Code
                    </label>
                    <input name="region_code"  value="{{ $province->region_code }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  id="username" type="text" placeholder="Ex. 100000000">
                    <small>@error('region_code') <p class="bg-red-500 text-white p-1">{{ $message }}</p> @enderror</small>
                </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      PSGC Code
                    </label>
                    <input name="psgc_code"   value="{{ $province->psgc_code }}"class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Ex. 1001300000">
                    <small>@error('psgc_code') <p class="bg-red-500 text-white p-1">{{ $message }}</p> @enderror</small>
                </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Island Name
                    </label>
                    <input name="island_name"  value="{{ $province->island_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Ex. Mindanao">
                    <small>@error('island_name') <p class="bg-red-500 text-white p-1">{{ $message }}</p> @enderror</small>
                </div> --}}
                  <div class="flex items-center justify-between">
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('admin.province.index') }}">
                       <i class="fa fa-arrow-left text-3xl"></i>
                      </a>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                     Update
                    </button>
                  </div>
                </form>
              </div>
            </section>
        </div>
    </section>
    <!---modal --->

    <div id="defaultModal" tabindex="-1" aria-hidden="true"  data-modal-backdrop="static" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Terms of Service
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <p class="text-base leading-relaxed text-red-500">
                        Deleting this data cannot retrieve anymore.
                    </p>
                    <p class="text-red-500">
                        Are you sure you want to delete this?
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <form method="POST" action="{{ route('admin.province.destroy',$province->id) }}">
                        @method('DELETE')
                        @csrf
                        <button data-modal-hide="defaultModal" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                    </form>
                    <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!---end modal-->


</main>
@endsection
