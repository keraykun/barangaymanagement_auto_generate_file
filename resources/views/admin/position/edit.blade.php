@extends('admin.layouts')
@section('content')

<div class="container mx-auto px-8">
<div class="mb-4">
    <a class="px-3 py-2 bg-white text-black shadow-2xl" href="{{ route('admin.official.index') }}">Back</a>
</div>

<div class="relative overflow-x-auto sm:rounded-lg">
    <div class="max-w-full relative">
        <i data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="fa fa-trash absolute top-0 right-0 text-md p-2 rounded-sm cursor-pointer m-2 text-white bg-red-500 hover:bg-red-800"></i>
        <form  method="POST" action="{{ route('admin.position.update',$position->id) }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PATCH')
            <div class="mb-4 flex-1">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Position Name
                </label>
                <input placeholder="Enter Unique" value="{{ $position->name }}" name="name"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text">
                <small>@error('name') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
            </div>
            <div class="mb-4 flex-1">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Role Unique
                </label>
                <select name="unique" id=""  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                    @if ($position->unique===0)
                        <option value="0">No Unique</option>
                        <option value="1">Yes Unique</option>
                    @else
                        <option value="1">Yes Unique</option>
                         <option value="0">No Unique</option>
                    @endif

                </select>
                <small>@error('unique') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
            </div>
          <div class="flex items-center justify-between">
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
                <form method="POST" action="{{ route('admin.position.destroy',$position->id) }}">
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
