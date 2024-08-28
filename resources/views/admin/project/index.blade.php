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
    <a class="px-3 py-2 bg-green-500 text-white hover:bg-green-600" href="{{ route('admin.district.create') }}">New District <i class="fa fa-plus font-bold"></i></a>
    <div class="w-full flex items-center justify-center">
        <form method="GET"  class="relative mb-4 flex min-w-[50%] flex-wrap items-stretch">
            <input
              type="search"
              name="search"
              style="background: white !important; "
              class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200  dark:focus:border-primary"
              placeholder="Search : District | Street | Zone "
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
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Banrangay / District / Zone / Street
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Active
                </th>
                <th scope="col" class="px-6 py-3">
                    Officials
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $project->barangay->name.' - '.$project->district.' - '.$project->zone.' - '.$project->address }}
                     </th>
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $project->name }}
                     </th>
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       {{ Str::limit($project->description , 20) }}
                     </th>
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ date('M d',strtotime($project->start_date_at)).' ~ '.date('M d',strtotime($project->end_date_at)).' / '.date('H a',strtotime($project->start_time_at)).' ~ '.date('H a',strtotime($project->end_time_at))    }}
                     </th>
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $project->active }}
                     </th>
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $project->officials->count() }}
                     </th>
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <a class="py-2 px-4 rounded-md  bg-green-500 text-white hover:bg-green-700" href="{{ route('admin.project.show',$project->id) }}">View</a>
                      </th>
                     {{-- <th scope="row" class="px-6 py-4 font-medium w-0 text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('admin.resident.show',$district->id) }}" class="flex items-center justify-center just gap-2 p-2 rounded-md text-slate-100 bg-green-500"><span class="text-md">{{ number_format($district->count) }}</span></a>
                     </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('admin.district.edit',$district->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </th> --}}
                </tr>
            @endforeach
        </tbody>

    </table>
    {{-- {{ $district->withQueryString()->links('pagination::bootstrap-4') }} --}}
</div>


@endsection