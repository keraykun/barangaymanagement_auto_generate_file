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
        <div style="z-index: 1; display:flex; justify-content:center; align-items:center; flex-direction:column;">

            <section style="display:flex; flex-direction:column; flex-wrap:wrap; justify-content:center; align-items:center;">
              <article class="barangay-choose" style="font-size: 2rem;">Province of {{ Str::ucfirst($barangays->province->name ) }}</article>
              <article class="barangay-choose" style="font-size: 2rem;">Municipal of {{ Str::ucfirst($barangays->name) }}</article>
            {{-- <article class="flex justify-between items-center gap-2">
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
            </article> --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">


            <!-- Modal toggle -->
            <div class="flex gap-3">
                <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="block mb-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    New Barangay
                </button>
                <a  href="{{ route('signout') }}" class="block mb-3 cursor-pointer text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-blue-800">
                    Sign Out
                </a>
            </div>
            <!-- Main modal -->
            <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <form method="POST" action="{{ route('admin.barangay.store') }}" class="bg-white px-8 pt-6 pb-8 mb-4 shadow-md">
                        @csrf
                    <div class="relative bg-white dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                               New Barangay
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                              <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="username">
                                  Barangay Name
                                </label>
                                <input name="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"   id="username" type="text" placeholder="Ex. Camp I">
                            </div>
                                <input type="hidden" name="municipal_id" value="1">
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-4 md:p-5 dark:border-gray-600">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Create
                               </button>
                            <button data-modal-hide="static-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            </div>

            <div style="max-height: 400px; overflow-y: auto;">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                              Logo
                            </th>
                            <th scope="col" class="px-6 py-3">
                             Barangay
                            </th>
                            <th scope="col" class="px-6 py-3">
                             Staff
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Detail
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                             </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangays->barangays->sortBy('name') as $barangay)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <a href="{{ route('admin.barangay.show',$barangay->id) }}" class="block px-4 py-2  hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span>{{ $barangay->name }}</span>
                                  </a>
                            </th>
                            <th class="px-6 py-4  text-gray-900">
                                <a href="{{ route('admin.barangay.show',$barangay->id) }}" class="block px-4 py-2  hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span>{{ $barangay->name }}</span>
                                  </a>
                            </th>
                            <th class="px-6 py-4  text-gray-900">
                                <span>{{ $barangay->admins->count() }}</span>
                            </th>
                                <!---view--->
                                <th class="px-6 py-4  text-gray-900 text-right">
                                    <a href="#" data-modal-target="static-modal-view-{{ $barangay->id }}" data-modal-toggle="static-modal-view-{{ $barangay->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                                    <!-- Main modal -->
                                    <div id="static-modal-view-{{ $barangay->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white dark:bg-gray-700 shadow-md">
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal-view-{{ $barangay->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>

                                                <div>
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                 <div class="flex items-center gap-2">
                                                    <button data-modal-target="static-modal-admin-{{ $barangay->id }}" data-modal-toggle="static-modal-admin-{{ $barangay->id }}" class="block mb-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        New Admin
                                                    </button>
                                                    <a  href="{{ route('admin.barangay.show',$barangay->id) }}" class="block mb-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >
                                                        Dashboard
                                                    </a>
                                                 </div>


                                                    <!-- Main modal -->
                                                    <div id="static-modal-admin-{{ $barangay->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-white dark:bg-gray-700">
                                                                <form  method="POST" action="{{ route('admin.admin.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                       New Admin
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal-admin-{{ $barangay->id }}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4">
                                                                        <div class="flex flex-col gap-4 justify-between">
                                                                            <div class="mb-4 flex-1">
                                                                                <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="username">
                                                                                 Full name
                                                                                </label>
                                                                                <input name="name"  required class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                                                                                <small>@error('name') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                                                                            </div>
                                                                            <div class="mb-4 flex-1">
                                                                                <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="username">
                                                                                 Username
                                                                                </label>
                                                                                <input name="email" required class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                                                                                <small>@error('email') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                                                                            </div>
                                                                            <div class="mb-4 flex-1">
                                                                                <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="username">
                                                                                 Password
                                                                                </label>
                                                                                <input name="password" required class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password">
                                                                                <small>@error('password') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                                                                            </div>
                                                                            <div class="mb-4 flex-1">
                                                                                <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="username">
                                                                                 Confirm Password
                                                                                </label>
                                                                                <input name="password_confirmation" required class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password">
                                                                                <small>@error('password_confirmation') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center p-4 md:p-5 dark:border-gray-600">
                                                                    @csrf
                                                                    <input type="hidden" name="barangay_id" value="{{ $barangay->id }}">
                                                                    <input type="hidden" name="role" value="secondary">
                                                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                                                        Create
                                                                       </button>
                                                                    <button data-modal-hide="static-modal-admin" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                                </div>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        {{ $barangay->name }}
                                                    </h3>
                                                    </div>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <!--table-->
                                                    <div class="relative overflow-x-auto" >
                                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                                <tr>
                                                                    <th scope="col" class="px-6 py-3">
                                                                        Name
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3">
                                                                        Email
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3">
                                                                        Role
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3">
                                                                        Action
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3">
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($barangay->admins as $admin)
                                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                        {{ $admin->name }}
                                                                    </th>
                                                                    <td class="px-6 py-4">
                                                                        {{ $admin->email }}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{ $admin->role }}
                                                                    </td>

                                                                    <td class="px-6 py-4">

                                                                        <!--edit user profile-->
                                                                        <a href="#" data-modal-target="static-modal-user-profile-{{ $admin->id }}" data-modal-toggle="static-modal-user-profile-{{ $admin->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit Profile</a>
                                                                            <!-- Main modal -->
                                                                            <div id="static-modal-user-profile-{{ $admin->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                                                    <!-- Modal content -->
                                                                                    <form  method="POST" action="{{ route('admin.admin.profile',$admin->id) }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                                                                                        @csrf
                                                                                        @method('PATCH')
                                                                                    <div class="relative bg-white dark:bg-gray-700">
                                                                                        <!-- Modal header -->
                                                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                                            Edit Admin
                                                                                            </h3>
                                                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal-user-profile-{{ $admin->id }}">
                                                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                                                </svg>
                                                                                                <span class="sr-only">Close modal</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <!-- Modal body -->
                                                                                        <div class="p-4 md:p-5 space-y-4">
                                                                                            <div class="flex flex-col gap-4 justify-between">
                                                                                                <div class="mb-4 flex-1">
                                                                                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                                                                                     Username
                                                                                                    </label>
                                                                                                    <input readonly disabled value="{{ $admin->email }} ( Can't Editable )"   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                                                                                                    <small>@error('email') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                                                                                                </div>
                                                                                                <div class="mb-4 flex-1">
                                                                                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                                                                                     Full name
                                                                                                    </label>
                                                                                                    <input name="name" value="{{ $admin->name }}"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                                                                                                    <small>@error('name') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- Modal footer -->
                                                                                        <div class="flex items-center justify-between p-4 md:p-5 dark:border-gray-600">
                                                                                        <div>
                                                                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                                                                                Update
                                                                                            </button>
                                                                                            <button data-modal-hide="static-modal-user-profile-{{ $admin->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                                                        </div>
                                                                                            <div>
                                                                                                <button data-modal-target="static-modal-profile-delete-{{ $admin->id }}" data-modal-toggle="static-modal-profile-delete-{{ $admin->id }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                                                                                                Delete
                                                                                                </button>
                                                                                            </form>

                                                                                                <!-- delete modal -->
                                                                                                <div  id="static-modal-profile-delete-{{ $admin->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                                                    <div class="relative p-4 w-full max-w-2xl max-h-full bg-red-400" style="border: 1px solid red !important;">
                                                                                                        <div class="bg-white dark:bg-gray-700">
                                                                                                            <div class="p-4 md:p-5 space-y-4 text-center text-2xl">
                                                                                                            Deleting this can't retrieve anymore?
                                                                                                            </div>
                                                                                                            <!-- Modal footer -->
                                                                                                            <div class="flex items-center p-4 md:p-5 dark:border-gray-600">
                                                                                                                <form method="POST" action="{{ route('admin.admin.destroy',$admin->id) }}">
                                                                                                                    @method('DELETE')
                                                                                                                    @csrf
                                                                                                                    <button data-modal-hide="defaultModal" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                                                                                                </form>
                                                                                                                <button data-modal-hide="static-modal-profile-delete-{{ $admin->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>

                                                                        <!---end edit profile-->

                                                                    </td>

                                                                    <td class="px-6 py-4">
                                                                        <!--edit user-->
                                                                        <a href="#" data-modal-target="static-modal-user-{{ $admin->id }}" data-modal-toggle="static-modal-user-{{ $admin->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit Password</a>
                                                                            <!-- Main modal -->
                                                                            <div id="static-modal-user-{{ $admin->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                                                    <!-- Modal content -->
                                                                                    <form  method="POST" action="{{ route('admin.admin.update',$admin->id) }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                                                                                        @csrf
                                                                                        @method('PATCH')
                                                                                    <div class="relative bg-white dark:bg-gray-700">
                                                                                        <!-- Modal header -->
                                                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                                            Edit Admin
                                                                                            </h3>
                                                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal-user-{{ $admin->id }}">
                                                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                                                </svg>
                                                                                                <span class="sr-only">Close modal</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <!-- Modal body -->
                                                                                        <div class="p-4 md:p-5 space-y-4">
                                                                                            <div class="flex flex-col gap-4 justify-between">
                                                                                                <div class="mb-4 flex-1">
                                                                                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                                                                                     Username
                                                                                                    </label>
                                                                                                    <input readonly disabled value="{{ $admin->email }} ( Can't Editable )"   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                                                                                                    <small>@error('email') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                                                                                                </div>

                                                                                                <div class="mb-4 flex-1">
                                                                                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                                                                                     Old Password
                                                                                                    </label>
                                                                                                    <input name="current_password"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password">
                                                                                                    <small>@error('current_password') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                                                                                                </div>
                                                                                                <div class="mb-4 flex-1">
                                                                                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                                                                                     New Password
                                                                                                    </label>
                                                                                                    <input name="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password">
                                                                                                    <small>@error('password') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                                                                                                </div>
                                                                                                <div class="mb-4 flex-1">
                                                                                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                                                                                     Confirm Password
                                                                                                    </label>
                                                                                                    <input name="password_confirmation" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password">
                                                                                                    <small>@error('password_confirmation') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- Modal footer -->
                                                                                        <div class="flex items-center justify-between p-4 md:p-5 dark:border-gray-600">
                                                                                        <div>
                                                                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                                                                                Update
                                                                                            </button>
                                                                                            <button data-modal-hide="static-modal-user-{{ $admin->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                                                        </div>
                                                                                            <div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>


                                                                        <!---end edit-->


                                                                    </td>

                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </th>
                            <!---edit--->
                            <th class="px-6 py-4  text-gray-900 text-right">
                                <a href="#" data-modal-target="static-modal-{{ $barangay->id }}" data-modal-toggle="static-modal-{{ $barangay->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <!-- Main modal -->
                                <div id="static-modal-{{ $barangay->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                            <form method="POST" action="{{ route('admin.barangay.update',$barangay->id) }}" class="relative bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                            @csrf
                                            @method('PATCH')
                                        <div class="relative bg-white dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                   Edit Barangay
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal-{{ $barangay->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                  <div class="mb-4">
                                                    <label class="block text-gray-700 text-sm font-bold mb-2 text-left" for="username">
                                                     Edit Barangay Name
                                                    </label>
                                                    <input name="name" value="{{ $barangay->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"   id="username" type="text" placeholder="Ex. Camp I">
                                                </div>
                                                    <input type="hidden" name="municipal_id" value="1">
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex items-center justify-between p-4 md:p-5 dark:border-gray-600">
                                               <div>
                                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                                    Update
                                                   </button>
                                                <button data-modal-hide="static-modal-{{ $barangay->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                               </div>
                                                <div>
                                                    <button data-modal-target="static-modal-delete-{{ $barangay->id }}" data-modal-toggle="static-modal-delete-{{ $barangay->id }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                                                      Delete
                                                    </button>
                                                </form>

                                                    <!-- delete modal -->
                                                    <div  id="static-modal-delete-{{ $barangay->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-red-400" style="border: 1px solid red !important;">
                                                            <div class="bg-white dark:bg-gray-700">
                                                                <div class="p-4 md:p-5 space-y-4 text-center text-2xl">
                                                                 Deleting this can't retrieve anymore?
                                                                </div>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center p-4 md:p-5 dark:border-gray-600">
                                                                    <form method="POST" action="{{ route('admin.barangay.destroy',$barangay->id) }}">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button data-modal-hide="defaultModal" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                                                    </form>
                                                                    <button data-modal-hide="static-modal-delete-{{ $barangay->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <form method="POST" action="{{ route('admin.barangay.destroy',$barangay->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-modal-hide="defaultModal" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                                    </form> --}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            </section>
        </div>
    </section>

</main>
@endsection
