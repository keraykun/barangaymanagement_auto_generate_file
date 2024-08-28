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

    <div class="w-full flex  items-center justify-center flex-row gap-5">
        <div class="text-2xl text-slate-600 uppercase">
            Monthly Date Reported
         </div>
       {{-- <form method="GET"  class="relative mb-4 flex gap-3 min-w-[50%]  items-stretch">
          <div class="w-full items-stretch">
            <select name="year" class="relative m-0 -mr-0.5 block w-[1px] w-full min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200  dark:focus:border-primary">
                @if (isset($year))
                @php

                    $yearNumber = (int)$year;
                    $yearName = \Carbon\Carbon::create()->year($yearNumber)->format('Y');
                @endphp
                <option value="{{ $yearName }}">{{ $yearName }}</option>
                @else
                <option disabled selected>Select Year</option>
                @endif
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022 </option>
                <option value="2021">2021</option>
            </select>
            <small>@error('year') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
          </div>
          <div class="w-full items-stretch">
            <select name="month" class="relative m-0 -mr-0.5 w-full  block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200  dark:focus:border-primary">
                @if (isset($month))
                @php

                    $monthNumber = (int)$month;
                    $monthName = \Carbon\Carbon::create()->month($monthNumber)->format('F');
                @endphp
                <option value="{{ date('m',strtotime($month)) }}">{{ $monthName }}</option>
                @else
                <option disabled selected>Select Month</option>
                @endif
                <option value="01">January </option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <small>@error('month') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
          </div>
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



          <form method="GET"  class="relative mb-4 flex min-w-[80%] gap-2 flex-wrap items-stretch">
            <div class="form-group">
                <label for="">From : </label>
                <input name="from_date" type="date" class="form-control">
            </div>
            <div class="form-group">
                <label for="">To : </label>
                <input name="to_date" type="date" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Complainant Name</label>
                <input name="search" type="text" class="form-control" style="width: 500px;">
            </div>
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
        {{-- <a href="{{ route('admin.monthly.print',1) }}" class="btn bg-blue-500 px-5 hover:bg-blue-600  text-white">Print</a> --}}
     </div>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table id="printTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
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
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 hideMe">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($reports as $report)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $report->id }}
                     </td>
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
                        @if ($report->remark==0)
                            <span>New</span>
                        @elseif($report->remark==1)
                            <span>On Progress</span>
                        @elseif($report->remark==2)
                             <span>Done</span>
                        @endif
                     </td>
                     <td class="hideMe">
                        <a href="{{ route('admin.monthly.show',$report->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">Show</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{ $reports->withQueryString()->links('pagination::bootstrap-4') }}
</div>
<script>
document.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('blotterReports').classList.add('show')
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
