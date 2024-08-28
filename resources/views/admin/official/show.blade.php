@extends('admin.layouts')
@section('content')

<style>
    input[type="search"]:focus {
        border: 2px solid rgb(19, 150, 95) !important;
    }
</style>
<div class="mb-5 flex flex-col">
    @if (Session::has('success'))
    <div class="text-green-600 text-2xl m-3 w-full text-center">
        <p class="">{{ Session::get('success') }}</p>
    </div>
    @elseif (Session::has('danger'))
    <div class="text-red-600 text-2xl m-3 w-full text-center">
         <p class="">Successfully <span class="font-bold">{{ Session::get('danger') }} </span> has been Removed</p>
    </div>
     @endif
     {{-- @if (auth()->user()->role=='admin') --}}
    <a class="self-start px-3 mb-2 py-2 bg-green-500 text-white hover:bg-green-600" href="{{ route('admin.official.create') }}">New Official <i class="fa fa-plus font-bold"></i></a>
    <a class="self-start px-3 py-2 bg-blue-500 text-white text-black shadow-2xl" href="{{ route('admin.official.index') }}">Back</a>
    {{-- @endif --}}

    <div class="w-full flex items-center justify-center">
        <form method="GET"  class="relative mb-4 flex min-w-[50%] flex-wrap items-stretch">
            <input
              type="search"
              name="search"
              style="background: white !important; "
              class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200  dark:focus:border-primary"
              placeholder="Search : Fullname | Firstname | Middlename | Lastname"
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
          </form>
    </div>
    <div class="self-end mr-5">
        <button onclick="printThisFile()" type="button" class="btn bg-blue-500 px-5 hover:bg-blue-600  text-white">Print</button>
    </div>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table id="printTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 hideMe">

                </th>
                <th scope="col" class="px-6 py-3">
                    Position
                </th>
                <th scope="col" class="px-6 py-3">
                     Name of Official
                </th>
                <th scope="col" class="px-6 py-3">
                    Total of Certificates
                </th>
                <th scope="col" class="px-6 py-3">
                    Contact
                </th>
                <th scope="col" class="px-6 py-3">
                    Active
                </th>
                @if (auth()->user()->role=='admin')
                <th scope="col" class="px-6 py-3 hideMe">
                    Action
                </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($position->officials as $official)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="px-6 py-4 hideMe">
                        @if ($official->image==='noimage.jpg')
                            <div class="w-20 rounded-md">
                                <img class="object-contain" src="{{ url('images/noimage.jpg') }}"/>
                            </div>
                        @else
                        <div class="w-20 rounded-md">
                            <img class="object-contain" src="{{ url('images/officials/'.$official->image) }}"/>
                        </div>
                        @endif
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @foreach ($official->positions as $position)
                            {{ $position->name }}
                        @endforeach
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       {{ $official->firstname.' '.$official->middlename.' '.$official->lastname }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $official->files_count }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $official->contact }}
                    </th>
                    {{-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ date('M d Y',strtotime($official->birthdate)) }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $official->gender }}
                    </th> --}}
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $official->is_active }}
                    </th>
                    <th scope="row" class="px-6 hideMe py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{-- @if (auth()->user()->role=='admin') --}}
                        <a href="{{ route('admin.official.certificate',$official->id) }}" class="font-medium mr-2 text-blue-600 dark:text-blue-500 hover:underline">View</a>
                        <a href="{{ route('admin.official.edit',$official->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        {{-- @endif --}}
                    </th>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{-- {{ $official->withQueryString()->links('pagination::bootstrap-4') }} --}}
</div>
<script>
    function printThisFile(){
       $('#printTable').printThis({
            importCSS: true,
            beforePrint:function(){
                $('.hideMe').css('display','none')
            },
            afterPrint:function(){
                $('.hideMe').css('display','inline')
            }
       });
    }
</script>
@endsection
