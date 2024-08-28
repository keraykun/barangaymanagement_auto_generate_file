@extends('admin.layouts')
@section('content')

<style>
    input[type="search"]:focus {
        border: 2px solid rgb(19, 150, 95) !important;
    }
</style>
<div class="mb-5">
    @if (Session::has('success'))
    <div class="text-green-600 text-2xl m-3 w-full text-center">
        <p class="">{{ Session::get('success') }}</p>
    </div>
    @elseif (Session::has('danger'))
    <div class="text-red-600 text-2xl m-3 w-full text-center">
         <p class="">Successfully <span class="font-bold">{{ Session::get('danger') }} </span> has been Removed</p>
    </div>
     @endif
    <a class="px-3 py-2 bg-green-500 text-white hover:bg-green-600" href="{{ route('admin.logo.create') }}">New logo <i class="fa fa-plus font-bold"></i></a>
    <div class="w-full flex items-center justify-center">
        {{-- <form method="GET"  class="relative mb-4 flex min-w-[50%] flex-wrap items-stretch">
            <input
              type="search"
              name="search"
              style="background: white !important; "
              class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200  dark:focus:border-primary"
              placeholder="Search : logo | Street | Zone "
              aria-label="Search"
              aria-describedby="button-addon1" />
            <!--Search button-->
            <button
              style="background: rgb(19, 150, 95) !important;"
              class="relative z-[2] flex items-center rounded-r bg-primary px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
              type="submit"
              id="button-addon1"
              data-te-ripple-init
              data-te-ripple-color="light">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-5 w-5">
                <path
                  fill-rule="evenodd"
                  d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                  clip-rule="evenodd" />
              </svg>
            </button>
          </form> --}}
    </div>
</div>
<div class="relative overflow-x-auto sm:rounded-lg">

    <div href="#" class="flex flex-row items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row  hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
       @if ($logo!=null)
        @if ($logo->name)
        <img class="p-10 w-full rounded-t-lg h-96 md:h-auto md:rounded-none md:rounded-l-lg" style="width: 600px; height:600px;" src="{{ asset('images/logos/'.$logo->name) }}" alt="">
        @else
            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"  style="width: 600px; height:600px;" src="{{ asset('images/noimage.jpg') }}" alt="">
        @endif
       @endif
        <div class="flex flex-col justify-between p-4 leading-normal w-full">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ Session::has('barangay')? Str::ucfirst(Session::get('barangay')->municipal->province->name).' , '.Str::ucfirst(Session::get('barangay')->municipal->name).' '.Str::ucfirst(Session::get('barangay')->name).' ( '.Str::ucfirst(Session::get('barangay')->municipal->region_name). ' ) ' : '' }}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">this logo is representative of this barangay.</p>
        </div>
    </div>

    {{-- <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Logo
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Date Created
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logos as $logo)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($logo->name)
                                <img src="{{ asset('images/logo.png') }}" alt="">
                            @else
                                <img style="width: 120px; height:120px;" src="{{ asset('images/logo.png') }}" alt="">
                            @endif
                     </th>
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ Str::ucfirst($logo->title) }}
                     </th>
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ date('M d, Y',strtotime($logo->created_at)) }}
                      </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('admin.logo.edit',$logo->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </th>
                </tr>
            @endforeach
        </tbody>

    </table> --}}
    {{-- {{ $logo->withQueryString()->links('pagination::bootstrap-4') }} --}}
</div>


@endsection
