@extends('admin.layouts')
@section('content')

<div class="container mx-auto px-8">
<div class="mb-4">
    <a class="px-3 py-2 bg-white text-black shadow-2xl" href="{{ route('admin.official.index') }}">Back</a>
</div>
{{-- @if (Session::has('danger'))
<div class="text-red-600 text-2xl m-3 w-full text-center">
     <p class=""><span class="font-bold">{{ Session::get('danger') }} </span>  Already Exist cannot be duplicate</p>
</div>
@endif --}}
<div class="relative overflow-x-auto sm:rounded-lg">
    <div class="max-w-[50%]">
        <form  method="POST" action="{{ route('admin.position.store') }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4 flex-1">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Position Name
                </label>
                <input placeholder="Enter Unique" value="{{ old('name') }}" name="name"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                <small>@error('name') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
            </div>
            <div class="mb-4 flex-1">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Role Unique
                </label>
                <select name="unique" id=""  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                    <option selected disabled value="">Select Unique</option>
                    <option value="0">No Unique</option>
                    <option value="1">Yes Unique</option>
                </select>
                <small>@error('unique') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
            </div>
          <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
              Create
            </button>
          </div>
        </form>
      </div>
</div>
</div>
<script>
    function positionRole(e){
        var value = e.value;
        var ids = e.options[e.selectedIndex].id;
        var text = e.options[e.selectedIndex].text;
        document.querySelector('#unique_role').value = ids
        document.querySelector('#unique_name').value = text
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
      document.getElementById('barangayManagement').classList.add('show')
  });
</script>
@endsection
