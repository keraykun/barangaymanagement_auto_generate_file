@extends('admin.layouts')
@section('content')

<div class="container mx-auto px-8">
<div class="mb-4">
    <a class="px-3 py-2 bg-white text-black shadow-2xl" href="{{ route('admin.logo.index') }}">Back</a>
</div>
@if (Session::has('success'))
<div class="text-green-600 text-2xl m-3 w-full text-center">
     <p class="font-bold">{{ Session::get('success') }} </p>
</div>
@endif
<div class="relative overflow-x-auto sm:rounded-lg">
    <div class="max-w-[70%]">
        <form  method="POST" enctype="multipart/form-data" action="{{ route('admin.logo.store') }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class=" flex gap-2">
                <div class="mb-4 flex-1">
                  @if ($logo!=null)
                      @if ($logo->name)
                      <img  class="p-10 w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" style="width: 600px; height:600px;" src="{{ asset('images/logos/'.$logo->name) }}" alt="">
                      @else
                      <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"  style="width: 600px; height:600px;" src="{{ asset('images/noimage.jpg') }}" alt="">
                      @endif
                  @endif
                </div>
              <div class="mb-4 flex-1">
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Upload Logo
                    </label>
                    <input name="logo" accept="image/jpeg, image/png"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="file">
                    <small>@error('logo') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Logo Title
                    </label>
                    <input placeholder="Enter Unique" value="{{ old('title') }}" name="title"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="text">
                    <small>@error('name') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
              </div>
              <div class="flex items-end justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create
                  </button>
            </div>

          </div>
        </form>
      </div>
</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
      document.getElementById('barangayManagement').classList.add('show')
  });
</script>
@endsection
