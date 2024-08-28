@extends('admin.layouts')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="mb-5" id="testMe">
    <div>
        <a class="py-2 px-3 bg-blue-500 text-white" href="{{ route('admin.indigency.list',$resident->id) }}">Back</a>
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
                            <article class="text-lg" >
                                <p class="indent-10">
                                    {{-- Thi is to certify that <span class="font-bold">{{ $resident->firstname.' '.$resident->middlename.' '.$resident->lastname.' ' }}</span>, of legal age, married, Filipino citizenand resident of {{ $resident->district->name }} Barangay {{ $resident->district->barangay->name }}, {{ $resident->district->barangay->municipal->name }}. --}}
                                </p>
                                <br>
                            </article>
                          </section>
                     </div>
                     <div class="article-right">
                        <section class="text-center flex flex-col gap-4  font-bold  items-center justify-center">
                            <p class="text-xl" style="border-bottom: 1px solid black;">CERTIFICATE OF INDEGENCY</p>
                          </section>
                          <section class="py-2 flex flex-col gap-4 text-md">
                            <p class="text-md">TO WHOM IT MAY CONCERN : </p>
                            <article class="text-lg"  contentEditable="true" id="content">
                                    {!!  $indigency->description !!}
                            </article>
                          </section>
                          <section class="py-2 items-end flex flex-col text-md ">
                            <div class="flex flex-col items-center">
                                <p style="border-bottom: 1px solid black; font-weight:bold;">{{ $kapitan->firstname.' '.$kapitan->middlename.' '.$kapitan->lastname }}</p>
                                <p>Punong Barangay</p>
                            </div>
                        </section>
                        <section class="pb-2 pt-[100px]  items-start flex flex-col text-md" style="font-family:pacifico;">
                            <span>Paid Under O R No. 4266532</span>
                            <div class="flex flex-col items-center">
                                <span class="w-full flex flex-row">
                                    <span style="margin-right: 60px;">Amount Paid</span>
                                    <span>: <span contentEditable="true" id="amountPaid" data-user="{{ $resident->id }}">{{ $indigency->price }}</span></span>
                                </span>
                                <span class="w-full flex flex-row">
                                    <span style="margin-right: 38px;">Date of Issuance</span>
                                    <span>: <span contentEditable="true" id="issuanceDate">{{ $indigency->issuance_of }}</span></span>
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

<script src="
https://cdn.jsdelivr.net/npm/flowbite@2.2.0/dist/flowbite.min.js
"></script>
<script>




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
