@extends('admin.layouts')
@section('content')

<style>
    input[type="search"]:focus {
        border: 2px solid rgb(19, 150, 95) !important;
    }
</style>
<div class="mb-5 flex flex-col">
    <div>
        <a class="py-2 px-3 bg-blue-500 text-white" href="{{ route('admin.staff.index') }}">Back</a>
    </div>

    @if (Session::has('success'))
    <div class="text-green-600 text-2xl m-3 w-full text-center">
        <p class="">{{ Session::get('success') }}</p>
    </div>
    @elseif (Session::has('danger'))
    <div class="text-red-600 text-2xl m-3 w-full text-center">
         <p class="">Successfully <span class="font-bold">{{ Session::get('danger') }} </span> has been Removed</p>
    </div>
     @endif

     <div class="w-full flex items-center justify-center flex-col">
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
                <label for="">Certificate</label>
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
    </div>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table id="printTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    STAFF NAME
                 </th>
                <th scope="col" class="px-6 py-3">
                   TYPES OF CERTIFICATES
                </th>
                <th scope="col" class="px-6 py-3">
                   TOTAL OF AMOUNT PAID
                </th>
                <th scope="col" class="px-6 py-3">
                    DATE TRANSACTION
                 </th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_amount = 0;
            @endphp
            @foreach ($certificates->files as $certificate)
                @php
                    $total_amount += $certificate->price??0;
                @endphp
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">

                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $users->name }}
                     </td>

                        @if ($certificate->reprint==null)
                         <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $certificate->belongsToFile->name  }}</td>
                        @else
                         <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $certificate->belongsToFile->name  }} ( Reprinted )</td>
                        @endif

                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        ₱ {{ number_format($certificate->price??0,2)}}
                     </td>
                     <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ date('M d ,Y',strtotime($certificate->created_at)) }}
                     </td>

                </tr>
            @endforeach
            <tr>

                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                 </td>
                 <td scope="row" class="px-6 py-4 text-red-500 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    TOTAL
                 </td>

                 <td scope="row" class="px-6 py-4 text-red-500  font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    @php
                        echo  ' ₱ '.number_format($total_amount,2);
                    @endphp
                 </td>
                 <td scope="row" class="px-6 py-4 text-red-500  font-medium text-gray-900 whitespace-nowrap dark:text-white">

                 </td>
            </tr>
        </tbody>
    </table>
    {{-- {{ $certificates->withQueryString()->links('pagination::bootstrap-4') }} --}}
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
