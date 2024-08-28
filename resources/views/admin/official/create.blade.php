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
@error('kagawad_limit')
<div class="text-red-600 text-2xl m-3 w-full text-center">
    <p class=""><span class="font-bold">{{ $message }} </span> </p>
</div>
@enderror
<div class="relative overflow-x-auto sm:rounded-lg">
    <div class="w-full min-w-sm">
        <form  method="POST" action="{{ route('admin.official.store') }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="flex flex-row gap-4 justify-between">
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Province
                    </label>
                    <input value="{{ Session::has('barangay')? Str::ucfirst(Session::get('barangay')->municipal->province->name)  : '' }}" readonly  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Municipal
                    </label>
                    <input value="{{ Session::has('barangay')? Str::ucfirst(Session::get('barangay')->municipal->name) : '' }}" readonly  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Barangay
                    </label>
                    <input value="{{ Session::has('barangay')? Str::ucfirst(Session::get('barangay')->name) : '' }}" readonly  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                </div>
            </div>
                <hr class="mt-2 mb-4">
            <div class="flex flex-row gap-4 justify-between">
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    First Name
                    </label>
                    <input placeholder="Enter Firstname" value="{{ old('firstname') }}" name="firstname"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                    <small>@error('firstname') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Middle Name
                    </label>
                    <input placeholder="Enter Middlename" value="{{ old('middlename') }}" name="middlename" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                    <small>@error('middlename') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Last Name
                    </label>
                    <input placeholder="Enter Lastname" value="{{ old('lastname') }}" name="lastname" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                    <small>@error('lastname') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
            </div>
            <div class="flex flex-row gap-4 justify-between">
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Birthdate
                    </label>
                    <input placeholder="2/4/2000" value="{{ old('birthdate') }}" name="birthdate"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="date">
                    <small>@error('birthdate') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Contact
                    </label>
                    <input size="11" maxlength="11" placeholder="Eg. 0919643533" value="{{ old('contact') }}" name="contact" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                    <small>@error('contact') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Gender
                    </label>
                    <select name="gender" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                        <option disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <small>@error('gender') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
            </div>
            <div class="mb-4 flex-1">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Position ( Role )
                </label>
                <select onclick="positionRole(this)" name="positions_id" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                    <option disabled selected>Select Position</option>
                    @foreach ($positions as $position)
                        <option id="{{ $position->unique }}" value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
                <small>@error('positions_id') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                <input type="hidden" name="unique_role" id="unique_role">
                <input type="hidden" name="unique_name" id="unique_name">
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
