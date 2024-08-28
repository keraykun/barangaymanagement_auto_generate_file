@extends('admin.layouts')
@section('content')

<style>
    input[type="search"]:focus {
        border: 2px solid rgb(19, 150, 95) !important;
    }
</style>
<div class="card mb-3">
    <div class="card-body">
        <a href="{{ route('admin.residentlist.create') }}" class="btn btn-info text-white">New resident</a>
    </div>
 </div>
<div class="mb-3 flex flex-col">
    {{-- @if (Session::has('success'))
    <div class="text-green-600 text-2xl m-3 w-full text-center">
        <p class="">{{ Session::get('success') }}</p>
    </div>
    @elseif (Session::has('danger'))
    <div class="text-red-600 text-2xl m-3 w-full text-center">
         <p class="">Successfully <span class="font-bold">{{ Session::get('danger') }} </span> has been Removed</p>
    </div>
     @endif --}}

     {{-- <form method="GET">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input value="{{ old('search') }}" name="search" style="padding-left: 50px !important;" type="search" id="default-search" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Search firsntname | middlename | lastname | contact | gender | purok ">
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form> --}}
    <div class="w-full flex items-center justify-center flex-col">
        <form method="GET"  class="relative mb-4 flex min-w-[80%] flex-wrap items-stretch gap-3">
            <label for="">From</label>
            <input type="text" name="from_age" placeholder="From Age" class=" border-neutral-300 bg-transparent form-control w-[10%]">
            <label for="">To</label>
            <input type="text" name="to_age" placeholder="To Age" class=" border-neutral-300 bg-transparent form-control w-[10%]">
            <label for="">Gender</label>
            <select name="gender" placeholder="Gender" class=" border-neutral-300 bg-transparent form-control w-[13%]">
                <option selected disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <input
              type="search"
              name="search"
              style="background: white !important; "
              class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200  dark:focus:border-primary"
              placeholder="Search Firsntname | Middlename | Lastname | Contact | Gender | Purok "
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
                <th scope="col" class="px-6 py-3">
                    Fullname
                </th>
                <th scope="col" class="px-6 py-3">
                    Contact
                </th>
                <th scope="col" class="px-6 py-3">
                    Gender
                </th>
                <th scope="col" class="px-6 py-3">
                    Birthdate
                </th>
                <th scope="col" class="px-6 py-3">
                    Purok
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="hideMe px-6 py-3">
                    Detail
                </th>
                <th class="hideMe">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($residents as $resident)
            @if (isset($_GET['search']) OR isset($_GET['page']))
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                {{-- <td class="px-6 py-4">
                    @if ($resident->image==='noimage.jpg')
                        <div class="w-20 rounded-md">
                            <img class="object-contain" src="{{ url('images/noimage.jpg') }}"/>
                        </div>
                    @else
                    <div class="w-20 rounded-md">
                        <img class="object-contain" src="{{ url('images/residents/'.$resident->image) }}"/>
                    </div>
                    @endif
                </td> --}}
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $resident->lastname.' , '.$resident->firstname.' '.$resident->middlename }}
                 </th>
                 <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $resident->contact }}
                 </th>
                 <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $resident->gender }}
                 </th>
                 <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{  date('Y') - date('Y',strtotime($resident->birthdate)).' ( '.date('M d ,Y',strtotime($resident->birthdate)).' ) '}}
                 </th>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $resident->district->barangay->name.' - '.$resident->district->name }}
                 </th>
                 <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $resident->status }}
                 </th>
                 <th scope="row" class="hideMe px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <a href="{{ route('admin.residentlist.detail',$resident->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Profile</a>
                </th>
                {{-- @if (auth()->user()->role=='admin') --}}
                <th scope="row" class="hideMe px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <a href="{{ route('admin.residentlist.edit',$resident->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </th>
                {{-- @endif --}}
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    @if (isset($_GET['search']) OR isset($_GET['page']))
    {{ $residents->withQueryString()->links('pagination::bootstrap-4') }}
    @endif
</div>
<script>
document.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('barangayReports').classList.add('show')
});
</script>
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
