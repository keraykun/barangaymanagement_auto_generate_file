@extends('admin.layouts')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="mb-5" id="testMe">
    <div>
        <a class="py-2 px-3 bg-blue-500 text-white" href="{{ route('admin.death.list',$resident->id) }}">Back</a>
    </div>
    <div class="w-full flex items-center justify-center gap-3" >
        <div class="w-[80%]">
            <div id="messageText">
                <p class="text-green-500 text-3xl text-center my-3"></p>
            </div>
            <div class="bg-white w-[100%] flex flex-col gap-5 py-3 px-1"  id="contentToPrint">
                <section class="flex justify-center items-center gap-3">
                    <article>
                        @if ($logo!=null)
                        @if ($logo->name)
                        <img src="{{ asset('images/logos/'.$logo->name) }}" style="width: 150px; height:150px;" alt="Your Image">
                        @else
                        <img src="{{ asset('images/nologo.png') }}" style="width: 150px; height:150px;" alt="Your Image">
                        @endif
                        @endif
                    </article>
                    <article class="text-lg text-center">
                        <p>Republic of the Philippines </p>
                        <p>Province of {{ $resident->district->barangay->municipal->province->name }} Municipality of {{ $resident->district->barangay->municipal->name }}</p>
                        <p class="font-bold">BARANGAY {{ Str::upper($resident->district->barangay->name) }}</p>
                        <p class="text-lg">OFFICE OF THE BARANGAY CHAIRMAN</p>
                    </article>
                  </section>
                  <div class="article-content flex gap-3">
                     <div class="article-left" style="width: 50%;">
                        <section class="text-center flex flex-col gap-2  items-center justify-center">
                            @if ($background!=null)
                            @if ($background->name)
                            <img src="{{ asset('images/background/'.$background->name) }}" style="width: 150px; height:150px;" alt="Your Image">
                            @else
                            <img src="{{ asset('images/nologo.png') }}" style="width: 150px; height:150px;" alt="Your Image">
                            @endif
                            @endif
                            <p style="font-weight:bold;"><u>{{ $kapitan->firstname.' '.$kapitan->middlename.' '.$kapitan->lastname }}</u></p>
                            <span>Punong Barangay</span>
                            <section class="py-2 flex flex-col gap-4 text-md">
                                <span  style="font-weight:bold;font-family:pacifico;">
                                    @foreach ($kagawads as $kagawad)
                                            <p><i>{{ $kagawad->firstname.' '.$kagawad->middlename.' '.$kagawad->lastname }}</i></p>
                                    @endforeach
                                </span>
                            <hr>
                            <span>Barangay Kagawad</span>
                          </section>
                     </div>
                     <div class="article-right" style="font-family:pacifico;">
                        <section class="text-center flex flex-col gap-4  font-bold  items-center justify-center">
                            <p class="text-xl" style="border-bottom: 1px solid black; margin-bottom:10px;">BARANGAY BUSINESS CLEARANCE</p>
                          </section>
                          <section class="py-1 flex flex-col gap-4 text-md">
                            <p class="text-md">TO WHOM IT MAY CONCERN </p>
                            <article class="text-lg" id="content">
                                {!!  $death->description !!}
                                {{-- <p class="text-md mb-2 uppercase">This is to certify :</p>

                                <p>
                                    <span style="margin-right: 40px;">TYPE OF BUSINESS</span><span class="font-bold"> : <span contentEditable="true">SARI-SARI STORE</span></span>
                                </p>
                                <p>
                                    <span style="margin-right: 32px;">NAME OF BUSINESS</span><span class="font-bold"> :  <span contentEditable="true"></span></span>
                                </p>
                                <p>
                                    <span style="margin-right: 20px;">NAME OF APPLICANT</span><span class="font-bold"> : <span contentEditable="true">{{  $resident->firstname.' '.$resident->middlename.' '.$resident->lastname}}</span></span>
                                </p>
                                <p contentEditable="true">
                                    Which operating a business at Barangay {{ $resident->district->barangay->name  }} , {{ $resident->district->barangay->municipal->name  }} {{ $resident->district->barangay->municipal->province->name  }} has undergone identification process and its operation conforms with the existing laws, rules, and regulation of the Barangay ( BARANGAY TAX REVENUE )
                                </p>
                                <br>
                                <p contentEditable="true">
                                    This document is issued to the applicant for presentation to the Business Permits and Licensing Office ( BPLO ), this Municipality, and all Offices and Agencies concerned prior to the issuance of MAYOR'S PERMIT/BUSINESS PERMIT LICENSE for the year 2023 regarding the said activity pursuant to Republic Act 9160 otherwise known as the Local Goverment Code.
                                </p> --}}
                            </article>
                          </section>
                          <section class="py-2 items-end flex flex-col text-md pt-2">
                            <div class="flex flex-col items-center">
                                <p style="border-bottom: 1px solid black; font-weight:bold;">{{ $kapitan->firstname.' '.$kapitan->middlename.' '.$kapitan->lastname }}</p>
                                <p>Punong Barangay</p>
                            </div>
                        </section>
                        <section class="pb-2 pt-[40px]  items-start flex flex-col text-md" style="font-family:pacifico;">
                            <span>Paid Under O R No. 4266532</span>
                            <div class="flex flex-col items-center">
                                <span class="w-full flex flex-row">
                                    <span style="margin-right: 60px;">Amount Paid</span>
                                    <span>: <span contentEditable="true" id="amountPaid" data-user="{{ $resident->id }}">{{ $death->price }}</span></span>
                                </span>
                                <span class="w-full flex flex-row">
                                    <span style="margin-right: 38px;">Date of Issuance</span>
                                    <span>: <span contentEditable="true" id="issuanceDate">{{ $death->issuance_of }}</span></span>
                                </span>
                                <span class="w-full flex flex-row">
                                    <span style="margin-right: 34px;">Place of Issuance</span>
                                    <span>: <span contentEditable="true">Barangay {{ $resident->district->barangay->name  }} , {{ $resident->district->barangay->municipal->name  }} {{ $resident->district->barangay->municipal->province->name  }}</span></span>
                                </span>
                            </div>
                        </section>
                     </div>
                  </div>
            </div>
        </div>
        {{-- <a class="py-2 px-3 bg-blue-400 text-2xl rounded-md" href="{{ route('admin.indigency.show',$resident->id) }}">print</a> --}}
        <div class="flex flex-col gap-5">
            <button class="py-2 px-3 bg-green-600 text-white rounded-md shadow-md" id="{{ $resident->id }}" onclick="printDiv(this)">Print</button>

            <p id="flowGgs" style="display:none;" data-modal-target="defaultModal" data-modal-toggle="defaultModal">Show Modal</p>
        </div>
    </div>
</div>
<div class="relative overflow-x-auto sm:rounded-lg">

</div>


<div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Terms of Service
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
            </div>
        </div>
    </div>
</div>
<script src="
https://cdn.jsdelivr.net/npm/flowbite@2.2.0/dist/flowbite.min.js
"></script>

<script>
    function storeToData(){
        var amount = $('#amountPaid');

        var userID = amount.data('user')
        var amountPaid = amount.text();
        var issuanceDate = $('#issuanceDate').text();
        var content = $('#content').html();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Include CSRF token for Laravel
            },
        });

        $.ajax({
            url: "{{ route('admin.business.store') }}",
            type: 'POST',
            data:{
                userID:userID,
                amountPaid:amountPaid,
                issuanceDate:issuanceDate,
                content:content
            },
            success: function(data) {
                $("#messageText").html('<p class="text-green-500 text-3xl text-center my-3">'+data+'</p>');
                console.log(data)
            },
            error: function(error) {
                console.log('Error fetching data:', error);
            }

        });
    }


    function printDiv(data)
    {

        $("#contentToPrint").printThis({
            loadCSS: 'css/pdf.css',
            beforePrint: function(){
                //$('body').css({'display':'none'})
            },
            afterPrint: function(){
                var content = $('#amountPaid').text();
                var price = parseFloat(content.match(/\d+/)[0]);
                // var userID = data.id;
                // console.log(userID)

                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Include CSRF token for Laravel
                //     },
                // });

                // $.ajax({
                //     url: "{{ route('admin.indigency.store') }}",
                //     type: 'POST',
                //     data:{userID:data.id,price:price},
                //     success: function(data) {
                //         console.log(data)
                //     },
                //     error: function(error) {
                //         console.log('Error fetching data:', error);
                //     }

                // });

               $('body').css({'display':'inline'})
              // $('#flowGgs').click()
            }
        });

    }
    // document.addEventListener("DOMContentLoaded", (event) => {
    //     document.getElementById('barangayManagement').classList.add('show')
    // });
    </script>

@endsection
