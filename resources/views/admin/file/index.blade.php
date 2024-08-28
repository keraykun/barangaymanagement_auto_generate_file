@extends('admin.layouts')
@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
       <div class="card">
        <div class="card-body text-2xl text-slate-600">
            Template Files
        </div>
       </div>
    </div>
    {{-- <div class="mb-4">
        @if (Session::has('success'))
        <div class="text-green-600 text-2xl m-3 w-full text-center">
            <p class="">{{ Session::get('success') }}</p>
        </div>
        @endif
    </div> --}}
    <div class="row">
        <div class="col-md-12" style="min-width:400px; margin-bottom:10px;">
            <div class="card">
                @error('file')
                    <span class="text-white bg-red-600">{{ $message }}</span>
                @enderror
                @if (auth()->user()->role!='staff')
                <div class="card-body my-2 ">
                    <form action="{{ route('admin.file.store') }}" enctype="multipart/form-data" method="POST" class="flex gap-3">
                      @csrf
                      <button type="button" id="fileBtn" class="py-2 px-3 bg-green-700 text-white rounded-md shadow-md">Upload File</button>
                      <input  type="file" id="fileInput" name="file" style="display: none;">
                      <input type="text" class="" name="name" id="fileName" placeholder="File name" required style="display: none;">
                      <input style="display: none;" type="text" class="" name="price" id="filePrice" placeholder="File Price (Philippine Peso)" required onkeyup="formatMoneyField(this);">
                      <script>
                          function formatMoneyField(input) {
                              let value = input.value;
                              value = value.replace(/[^\d.]/g, '');
                              input.value = value;
                          }
                      </script>
                      {{-- <input type="text" class="" name="otr" id="otrName" placeholder="Otr name" required style="display: none;"> --}}
                      <input class="py-2 px-3 bg-green-700 text-white rounded-md shadow-md" type="submit" id="submitBtn" style="display: none;">
                    </form>
                </div>
                @endif

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const fileBtn = document.getElementById("fileBtn");
                        const fileInput = document.getElementById("fileInput");
                        const fileName = document.getElementById("fileName");
                        const filePrice = document.getElementById("filePrice");
                       // const otrName = document.getElementById("otrName");
                        const submitBtn = document.getElementById("submitBtn");

                        fileBtn.addEventListener("click", function() {
                            // Toggle visibility of file input and submit button
                            fileInput.style.display = fileInput.style.display === "none" ? "block" : "none";
                            fileName.style.display = fileName.style.display === "none" ? "block" : "none";
                            filePrice.style.display = filePrice.style.display === "none" ? "block" : "none";
                          //  otrName.style.display = otrName.style.display === "none" ? "block" : "none";
                            submitBtn.style.display = submitBtn.style.display === "none" ? "block" : "none";
                            // Change button text based on visibility
                            fileBtn.textContent = fileBtn.textContent === "Upload File" ? "Cancel" : "Upload File";
                            // Change button color based on text
                            if (fileBtn.textContent === "Cancel") {
                                fileBtn.style.backgroundColor = "red";
                            } else {
                                fileBtn.style.backgroundColor = "green";
                            }
                        });
                    });
                    </script>
            </div>
        </div>
        @foreach ($files as $file)
        <div class="col-md-3 mt-2" style="min-width:400px;">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-2xl text-center font-bold uppercase">{{ $file->name }}</h1>
                </div>
                @if (auth()->user()->role!='staff')
                <div class="card-header text-center">

                    <button data-modal-target="static-modal-update-{{ $file->id }}" data-modal-toggle="static-modal-update-{{ $file->id }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        Edit
                      </button>

                      <div  id="static-modal-update-{{ $file->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-blue-400" style="border: 1px solid blue !important;">
                            <div class="bg-white dark:bg-gray-700">
                                <div class="p-4 md:p-5 space-y-4 text-center text-2xl">
                                Editting : <b class="uppercase"> {{ $file->name }}</b>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center flex-col gap-3 p-4 md:p-5 dark:border-gray-600">

                                    <form method="POST" class="flex flex-col gap-3" action="{{ route('admin.file.update',$file->id) }}">
                                        @method('PATCH')
                                        @csrf
                                       <div class="form-group">
                                        <input type="text" class="form-control mb-2" name="name" id="fileName" value="{{ $file->name }}" placeholder="File name" required style="">
                                        <input style="" type="text" class="form-control" name="price" value="{{ $file->price }}" id="filePrice" placeholder="File Price (Philippine Peso)" required onkeyup="formatMoneyField(this);">
                                       </div>
                                       <div>
                                        <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Update</button>
                                        <button data-modal-hide="static-modal-update-{{ $file->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                       </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @endif
                <a href="{{ route('admin.file.show',$file->id) }}"  class="card-body text-center flex flex-col gap-2">
                    <i class="fa fa-file-word text-8xl"></i>
                    <small><b>Price : </b> {{ number_format($file->price,2) }} Peso</small>
                    <small>{{ $file->content }}</small>
                </a>
                @if (auth()->user()->role!='staff')
                <div class="card-footer text-center">
                    <button data-modal-target="static-modal-delete-{{ $file->id }}" data-modal-toggle="static-modal-delete-{{ $file->id }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                        Delete
                      </button>
                      <div  id="static-modal-delete-{{ $file->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-red-400" style="border: 1px solid red !important;">
                            <div class="bg-white dark:bg-gray-700">
                                <div class="p-4 md:p-5 space-y-4 text-center text-2xl">
                                    The file is already in use, are you sure you want to delete this file
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-4 md:p-5 dark:border-gray-600">
                                    <form method="POST" action="{{ route('admin.file.destroy',$file->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button data-modal-hide="defaultModal" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                    </form>
                                    <button data-modal-hide="static-modal-delete-{{ $file->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
