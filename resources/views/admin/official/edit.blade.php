@extends('admin.layouts')
@section('content')

<div class="container mx-auto px-8">
<div class="mb-4">
    @if (Session::has('success'))
    <div class="text-green-600 text-2xl m-3 w-full text-center">
        <p class="">{{ Session::get('success') }}</p>
    </div>
    @endif
 <div class="flex justify-between">
    <a class="px-3 py-2 bg-blue-500 text-white text-black shadow-2xl" href="{{ url()->previous() }}">Back</a>
    <i class="fa fa-trash text-lg bg-red-500 px-2 py-1 cursor-pointer rounded-sm text-white"  data-modal-target="defaultModal-{{ $official->id }}" data-modal-toggle="defaultModal-{{ $official->id }}"></i>
 </div>
</div>
<div class="relative overflow-x-auto sm:rounded-lg">
    <div class="w-full min-w-sm">
        <form  enctype="multipart/form-data" method="POST" action="{{ route('admin.official.update',$official->id) }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4 flex justify-around gap-x-7">
            @csrf
            @method("PATCH")
            <section class="flex-none w-48 h-48 relative">
                @if ($official->image=='noimage.jpg')
                <img id="image"  class="h-full w-full" src="{{ asset('images/noimage.jpg') }}"/>
                <input id="file" onchange="loadFile(event)" accept="image/png,image/jpeg" type="file" name="image" class="w-full h-full absolute inset-0 opacity-0 cursor-grab">
                <input type="hidden" name="old_image" value="{{ $official->image }}">
                @else
                <img id="image"  class="h-full w-full" src="{{ asset('images/officials/'.$official->image) }}"/>
                <input id="file" onchange="loadFile(event)" accept="image/png,image/jpeg" type="file" name="image" class="w-full h-full absolute inset-0 opacity-0 cursor-grab">
                <input type="hidden" name="old_image" value="{{ $official->image }}">
                @endif
            </section>
            <section class="flex-1">
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
                        <input placeholder="Enter Firstname" value="{{ $official->firstname }}" name="firstname"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                        <small>@error('firstname') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Middle Name
                        </label>
                        <input placeholder="Enter Middlename" value="{{ $official->middlename }}" name="middlename" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                        <small>@error('middlename') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Last Name
                        </label>
                        <input placeholder="Enter Lastname" value="{{ $official->lastname }}" name="lastname" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                        <small>@error('lastname') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                </div>
                <div class="flex flex-row gap-4 justify-between">
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Birthdate
                        </label>
                        <input placeholder="2/4/2000" value="{{ $official->birthdate }}" name="birthdate"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="date">
                        <small>@error('birthdate') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Contact
                        </label>
                        <input size="11" maxlength="11" placeholder="Eg. 0919643533" value="{{ $official->contact }}" name="contact" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                        <small>@error('contact') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Gender
                        </label>
                        <select name="gender" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                            @if ($official->gender=='Female')
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            @endif
                            @if ($official->gender=='Male')
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            @endif
                        </select>
                        <small>@error('gender') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                </div>
                <div class="flex flex-row gap-4 justify-between">
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Position ( Role Cannot be Edit )
                    </label>
                    <select onclick="positionRole(this)" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                        @foreach ($official->positions as $position)
                            <option id="{{ $position->unique }}" value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                    <small>@error('positions_id') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                 <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Active
                        </label>
                        <select name="active" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                            @if ($official->is_active=='Yes')
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            @endif
                            @if ($official->is_active=='No')
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            @endif
                        </select>
                        <small>@error('active') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                      Update
                    </button>
                  </div>
            </section>
        </form>
    </div>
</div>
    <!---modal --->

    <div id="defaultModal-{{ $official->id }}" tabindex="-1" aria-hidden="true"  data-modal-backdrop="static" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Terms of Service
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal-{{ $official->id }}">
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
                    <form method="POST" class="m-0" action="{{ route('admin.official.destroy',$official->id) }}">
                        @method('DELETE')
                        @csrf
                        <button data-modal-hide="defaultModal-{{ $official->id }}" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                    </form>
                    <button data-modal-hide="defaultModal-{{ $official->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!---end modal-->
</div>
<script>
    function positionRole(e){
        var value = e.value;
        var text = e.options[e.selectedIndex].id;
        document.querySelector('#unique_role').value = text
    }
    function loadFile(event) {
        var image = document.getElementById('image');
        image.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
      document.getElementById('barangayManagement').classList.add('show')
  });
</script>
@endsection
