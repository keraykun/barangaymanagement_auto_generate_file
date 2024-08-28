@extends('admin.layouts')
@section('content')

<style>
    input[type="search"]:focus {
        border: 2px solid rgb(19, 150, 95) !important;
    }
</style>
<div class="mb-5">
    {{-- @if (Session::has('success'))
    <div class="text-green-600 text-2xl m-3 w-full text-center">
        <p class="">{{ Session::get('success') }}</p>
    </div>
    @elseif (Session::has('danger'))
    <div class="text-red-600 text-2xl m-3 w-full text-center">
         <p class="">Successfully <span class="font-bold">{{ Session::get('danger') }} </span> has been Removed</p>
    </div>
     @endif --}}
        @if ($report->remark==1)
        <div class="flex flex-col items-start gap-2">
            <button type="button" class="px-3 py-2 bg-green-500 text-white hover:bg-green-600" data-modal-target="defaultModal-{{ $report->id }}" data-modal-toggle="defaultModal-{{ $report->id }}" >Mark as Unsettle <i class="fa fa-edit"></i></button>
            <a class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" href="{{ route('admin.report.index') }}">Back</a>
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
                                <p class="text-base leading-relaxed text-green-700">
                                    Updating data...
                                </p>
                                <p class="text-green-700">
                                    Are you sure you want to Unsettle this?
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <form method="POST" action="{{ route('admin.report.progress',$report->id) }}">
                                    @method('PATCH')
                                    @csrf
                                    <button data-modal-hide="defaultModal-{{ $report->id }}" type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Mark as Unsettle</button>
                                </form>
                                <button data-modal-hide="defaultModal-{{ $report->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @elseif($report->remark==2)
        <div class="flex flex-col items-start gap-2">
            <button type="button" class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" data-modal-target="defaultModal-{{ $report->id }}" data-modal-toggle="defaultModal-{{ $report->id }}" >Mark as Done <i class="fa fa-spinner"></i></button>
            <a class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" href="{{ route('admin.report.index') }}">Back</a>
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
                                <p class="text-base leading-relaxed text-green-700">
                                   Updating data...
                                </p>
                                <p class="text-green-700">
                                    Are you sure you want to Done this?
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <form method="POST" action="{{ route('admin.report.done',$report->id) }}">
                                    @method('PATCH')
                                    @csrf
                                    <button data-modal-hide="defaultModal-{{ $report->id }}" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Mark as Done</button>
                                </form>
                                <button data-modal-hide="defaultModal-{{ $report->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @elseif($report->remark==3)
        <div class="flex flex-col items-start gap-2">
            <button type="button" class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" data-modal-target="defaultModal-{{ $report->id }}" data-modal-toggle="defaultModal-{{ $report->id }}" >Mark as Progress <i class="fa fa-spinner"></i></button>
            <a class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" href="{{ route('admin.district.index') }}">Back</a>
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
                                <p class="text-base leading-relaxed text-green-700">
                                   Updating data...
                                </p>
                                <p class="text-green-700">
                                    Are you sure you want to Progress this?
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <form method="POST" action="{{ route('admin.report.progress',$report->id) }}">
                                    @method('PATCH')
                                    @csrf
                                    <button data-modal-hide="defaultModal-{{ $report->id }}" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Mark as Progress</button>
                                </form>
                                <button data-modal-hide="defaultModal-{{ $report->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endif

    <div class="flex gap-3">
            <div class="card mt-3 flex-1">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item  flex justify-between"><span>Complainant Name</span><span>{{ $report->name }}</span></li>
                      <li class="list-group-item  flex justify-between"><span>Complainant Resident</span><span>{{ $report->resident_name }}</span></li>
                      <li class="list-group-item  flex justify-between"><span>Date Reported</span><span>{{ $report->date_reported }}</span></li>
                      <li class="list-group-item  flex justify-between"><span>Date Incident</span><span>{{ $report->date_incident }}</span></li>
                      <li class="list-group-item  flex justify-between"><span>Date Recorded</span><span>{{ $report->date_recorded }}</span></li>
                      <li class="list-group-item  flex justify-between"><span>Remark</span>
                        <span>
                        @if ($report->remark==1)
                            <span>New</span>
                        @elseif($report->remark==2)
                            <span>On Progress</span>
                        @elseif($report->remark==3)
                             <span>Done</span>
                        @endif
                        </span>
                    </li>
                    </ul>
                  </div>
            </div>
            <div class="card mt-3 flex-1">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item  flex justify-between"><span>Involved Name</span><span>{{ $report->involved }}</span></li>
                      <li class="list-group-item  flex justify-between"><span>Action</span><span>{{ $report->actions }}</span></li>
                      <li class="list-group-item  flex justify-between"><span>Statements</span>
                        <li class="list-group-item  flex justify-between"><span>{{ $report->statements }}</span>
                    </li>
                    </ul>
                  </div>
            </div>
        </div>
   </div>

<script>
document.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('blotterReports').classList.add('show')
});
</script>
@endsection
