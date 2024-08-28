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
              <article class="barangay-choose " style="font-size: 2rem; color:#66666;">Create Province</article>
              <div class="w-full">
                <form method="POST" action="{{ route('admin.province.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      Province Name
                    </label>
                    <input name="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"   id="username" type="text" placeholder="Ex. Bukidnon">
                    <small>@error('name') <p class="bg-red-500 text-white p-1">{{ $message }}</p> @enderror</small>
                </div>
                  {{-- <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      Province Code
                    </label>
                    <input name="code" value="{{ old('code') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  id="username" type="text" placeholder="Ex. 101300000">
                    <small>@error('code') <p class="bg-red-500 text-white p-1">{{ $message }}</p> @enderror</small>
                </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      Region Code
                    </label>
                    <input name="region_code" value="{{ old('region_code') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  id="username" type="text" placeholder="Ex. 100000000">
                    <small>@error('region_code') <p class="bg-red-500 text-white p-1">{{ $message }}</p> @enderror</small>
                </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      PSGC Code
                    </label>
                    <input name="psgc_code" value="{{ old('psgc_code') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Ex. 1001300000">
                    <small>@error('psgc_code') <p class="bg-red-500 text-white p-1">{{ $message }}</p> @enderror</small>
                </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Island Name
                    </label>
                    <input name="island_name" value="{{ old('island_name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Ex. Mindanao">
                    <small>@error('island_name') <p class="bg-red-500 text-white p-1">{{ $message }}</p> @enderror</small>
                </div> --}}
                  <div class="flex items-center justify-between">
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('admin.province.index') }}">
                       <i class="fa fa-arrow-left text-3xl"></i>
                      </a>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                     Create
                    </button>
                  </div>
                </form>

              </div>
            </section>
        </div>
    </section>

</main>
@endsection
