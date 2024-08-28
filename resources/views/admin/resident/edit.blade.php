@extends('admin.layouts')
@section('content')

<div class="container mx-auto px-8">
<div class="mb-4 flex justify-between">

    <a class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" href="{{ route('admin.resident.show',$resident->district->id) }}">Back</a>
    <i class="fa fa-trash text-lg bg-red-500 px-2 py-1 cursor-pointer rounded-sm text-white"  data-modal-target="defaultModal" data-modal-toggle="defaultModal"></i>
</div>
@if (Session::has('success'))
<div class="text-green-600 text-2xl m-3 w-full text-center">
    <p class="">{{ Session::get('success') }}</p>
</div>
@endif
<div class="relative overflow-x-auto sm:rounded-lg">
    <h1 class="my-3 text-2xl font-bold text-slate-600">Update Resident</h1>
    <div class="w-full min-w-sm">
        <form  method="POST" action="{{ route('admin.resident.update',$resident->id) }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PATCH')
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
            <div class="flex flex-row gap-4 justify-between">
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Purok
                    </label>
                    <input value="{{ $resident->district->name }}" readonly  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                </div>
                {{-- <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Zone
                    </label>
                    <input value="{{ $resident->district->zone }}" readonly  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Street
                    </label>
                    <input value="{{ $resident->district->address }}" readonly  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                </div> --}}
            </div>
                <hr class="mt-2 mb-4">
            <div class="flex flex-row gap-4 justify-between">
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    First Name
                    </label>
                    <input placeholder="Enter Firstname" value="{{ $resident->firstname }}" name="firstname"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                    <small>@error('firstname') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Middle Name
                    </label>
                    <input placeholder="Enter Middlename" value="{{ $resident->middlename  }}" name="middlename" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                    <small>@error('middlename') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Last Name
                    </label>
                    <input placeholder="Enter Lastname" value="{{ $resident->lastname  }}" name="lastname" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                    <small>@error('lastname') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
            </div>
            <div class="flex flex-row gap-4 justify-between">
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Birthdate
                    </label>
                    <input placeholder="2/4/2000" value="{{ $resident->birthdate  }}" name="birthdate"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="date">
                    <small>@error('birthdate') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Contact
                    </label>
                    <input size="11" maxlength="11" placeholder="Eg. 0919643533" value="{{ $resident->contact  }}" name="contact" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                    <small>@error('contact') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Gender
                    </label>
                    <select name="gender" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                        @if ($resident->gender=='Female')
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        @endif
                        @if ($resident->gender=='Male')
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        @endif
                    </select>
                    <small>@error('gender') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
            </div>

          <div class="flex items-center justify-between">
            <input type="hidden" name="id" value={{ $resident->id }}>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Update
            </button>
          </div>
        </form>
      </div>
</div>
 <!---modal --->

 <div id="defaultModal" tabindex="-1" aria-hidden="true"  data-modal-backdrop="static" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                <p class="text-base leading-relaxed text-red-500">
                    Deleting this data cannot retrieve anymore.
                </p>
                <p class="text-red-500">
                    Are you sure you want to delete this?
                </p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <form method="POST" action="{{ route('admin.resident.destroy',$resident->id) }}">
                    @method('DELETE')
                    @csrf
                    <button data-modal-hide="defaultModal" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                </form>
                <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!---end modal-->
</div>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        document.getElementById('barangayManagement').classList.add('show')
    });
</script>

@endsection
