@extends('admin.layouts')
@section('content')


<style>
    table, th, td {
        border: none;
      /* border: 1px solid; */
    }
    table{
        border-collapse: collapse;
        width: 100%;
        font-family: sans-serif;
    }
    </style>
<div class="mb-5">f

    <div class="w-full flex items-center justify-center">
        <div class="bg-white flex-col gap-5 py-3">
            <section class="flex justify-center items-center gap-5" id="PrintMes">
                <article>
                    @if ($logo->name)
                    <img src="{{ asset('images/logos/'.$logo->name) }}" style="width: 200px; height:200px;" alt="Your Image">
                    @else
                    <img src="images/nologo.jpg" style="width: 250px; height:150px;" alt="Your Image">
                    @endif
                </article>
                <article class="text-lg text-center">
                    <p>Republic of the Philippines </p>
                    <p>Province of {{ $resident->district->barangay->municipal->province->name }} Municipality of {{ $resident->district->barangay->municipal->name }}</p>
                    <p class="font-bold">BARANGAY {{ Str::upper($resident->district->barangay->name) }}</p>
                </article>
                {{-- <tr>
                  <th style="width: 250px; padding:0px;">
                    @if ($logo->name)
                    <img src="{{ asset('images/logos/'.$logo->name) }}" style="width: 200px; height:200px;" alt="Your Image">
                    @else
                    <img src="images/nologo.jpg" style="width: 250px; height:150px;" alt="Your Image">
                    @endif
                  </th>
                  <th>
                    <div style="width: 600px;">

                    </div>
                  </th>
                </tr>
                <tr>
                    <th colspan="2"><span style="text-decoration: underline;"></span></th></th>
                </tr>
                <tr>
                    <th colspan="2" style="height: 50px;"></th>
                </tr>
                <tr>
                    <th colspan="2"><span style="font-size:1.5rem;"></span></th>
                </tr> --}}
              </section>
              <section class="text-center flex flex-col gap-4  font-bold">
                <p class="text-xl">OFFICE OF THE BARANGAY CHAIRMAN</p>
                <p class="text-2xl" style=" text-decoration-line: underline; text-decoration-style: double;">CERTIFICATE OF INDEGENCY</p>
              </section>
              <section class="py-2 px-[100px] flex flex-col gap-4 text-lg">
                <p class="text-md">TO WHOM IT MAY CONCERN</p>
                <article  contentEditable="true" id="content">
                    <p class="indent-10">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus sapiente neque eaque iste cumque recusandae ipsa nesciunt! Molestias ipsum, adipisci dolorem facilis ad numquam dolore hic at explicabo quod harum?
                    </p>
                </article>
                {{-- <p class="indent-10">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus sapiente neque eaque iste cumque recusandae ipsa nesciunt! Molestias ipsum, adipisci dolorem facilis ad numquam dolore hic at explicabo quod harum?
                </p> --}}
              </section>
        </div>

        {{-- <button onclick="printFile()">Print File</button> --}}
    </div>
</div>
<div class="relative overflow-x-auto sm:rounded-lg">

</div>
@endsection
