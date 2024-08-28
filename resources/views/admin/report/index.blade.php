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
   <div class="flex flex-col items-start gap-2">
    <a class="px-3 py-2 bg-green-500 text-white hover:bg-green-600" href="{{ route('admin.report.create') }}">New Report<i class="fa fa-plus font-bold"></i></a>
    <a class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" href="{{ route('admin.district.index') }}">Back</a>
    </div>
    <div class="w-full flex items-center justify-center flex-col">
        <form method="GET"  class="relative mb-4 flex min-w-[50%] gap-2 flex-wrap items-stretch">
            <select name="case" id="" style="background: white !important;" class="p-2 dark:text-neutral-200  dark:focus:border-primary flex-auto rounded-l border border-solid border-neutral-300 bg-transparent">
                <option selected>SELECT CASE</option>
                <option value="1">PENDING </option>
                <option value="2">UNSETTLED</option>
                <option value="3">CLOSED </option>
            </select>
            <input
              type="search"
              name="search"
              style="background: white !important; "
              class="w-50 relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200  dark:focus:border-primary"
              placeholder="Search : Lastname | Firstname | Middlename  | Contact | Gender | Barangay "
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
                    Complainant
                </th>
                <th scope="col" class="px-6 py-3">
                    Statement
                </th>
                <th scope="col" class="px-6 py-3">
                    Involved
                </th>
                <th scope="col" class="px-6 py-3">
                    Location
                </th>
                <th scope="col" class="px-6 py-3">
                    Date Reported
                </th>
                <th scope="col" class="px-6 py-3">
                    Date Incident
                </th>
                <th scope="col" class="px-6 py-3 hideMe">
                    Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $report->name }}
                     </td>
                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ Str::limit($report->statements ,30, '...') }}
                     </td>
                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $report->involved }}
                     </td>
                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $report->location }}
                     </td>
                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $report->date_reported }}
                     </td>
                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $report->date_incident }}
                     </td>
                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if ($report->remark==1)
                            <span>PENDING</span>
                        @elseif($report->remark==2)
                            <span>UNSETTLED</span>
                        @elseif($report->remark==3)
                             <span>CLOSED</span>
                        @endif
                     </td>
                     <td class="hideMe">
                        <a href="{{ route('admin.report.edit',$report->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">Edit</a>
                        <a href="{{ route('admin.report.show',$report->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">Show</a>
                        <a href="{{ route('admin.report.file',$report->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">Print</a>
                        <button type="button" data-modal-target="defaultModal-{{ $report->id }}" data-modal-toggle="defaultModal-{{ $report->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">Delete</button>
                        <div id="defaultModal-{{ $report->id }}" tabindex="-1" aria-hidden="true"  data-modal-backdrop="static" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                                        <form method="POST" action="{{ route('admin.report.destroy',$report->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button data-modal-hide="defaultModal-{{ $report->id }}" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                        </form>
                                        <button data-modal-hide="defaultModal-{{ $report->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                     {{-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('admin.report.detail',$report->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Show</a>
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('admin.report.edit',$report->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </th> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $reports->withQueryString()->links('pagination::bootstrap-4') }}
</div>
<script>
document.addEventListener("DOMContentLoaded", (event) => {
    // document.getElementById('blotterReports').classList.add('show')
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
