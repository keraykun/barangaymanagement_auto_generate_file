@extends('admin.layouts')
@section('content')

<style>
    input[type="search"]:focus {
        border: 2px solid rgb(19, 150, 95) !important;
    }
</style>
<div class="mb-5">
    @if (Session::has('success'))
    <div class="text-green-600 text-2xl m-3 w-full text-center">
        <p class="">{{ Session::get('success') }}</p>
    </div>
    @elseif (Session::has('danger'))
    <div class="text-red-600 text-2xl m-3 w-full text-center">
         <p class="">Successfully <span class="font-bold">{{ Session::get('danger') }} </span> has been Removed</p>
    </div>
     @endif
   <div class="flex flex-col items-start gap-2">
    <a class="px-3 py-2 bg-blue-500 text-white hover:bg-blue-600" href="{{ route('admin.report.index') }}">Back</a>
    </div>

</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="card">
        <div class="card-body">
            <form  method="POST" action="{{ route('admin.report.update',$report->id) }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="flex flex-row gap-4 justify-between">
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                         Complainant
                        </label>
                        <input name="name" value="{{ $report->name }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                        <small>@error('name') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                         Resident Complainant
                        </label>
                        {{-- <select onclick="positionRole(this)" name="positions_id" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                            <option id="yes" value="yes">Yes</option>
                        </select> --}}
                        <input name="resident" value="{{ $report->resident_name }}"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                        <small>@error('resident') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                         Location
                        </label>
                        <input value="{{ $report->location }}"  name="location" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                        <small>@error('location') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                </div>

                <div class="flex flex-row gap-1 justify-between">
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                         Involved
                        </label>
                        <input value="{{ $report->involved }}"  name="involved" class="appearance-none border rounded py-2 px-3 w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                        <small>@error('involved') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>

                </div>
                <div class="flex flex-row gap-4 justify-between">
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                         Action
                        </label>
                        <input value="{{ $report->actions }}"  name="action" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                        <small>@error('action') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                </div>
                <div class="flex flex-row gap-4 justify-between">
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                         Statement
                        <textarea name="statement" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10">{{ $report->statements }}</textarea>
                        <small>@error('statement') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                </div>
                <div class="flex flex-row gap-4 justify-between">
                    {{-- <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                         Date Reported
                        </label>
                        <input value="{{ $report->date_reported }}"  name="date_reported" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="date">
                        <small>@error('date_reported') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div> --}}
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                         Date Incident
                        </label>
                        <input  value="{{ $report->date_incident }}" name="date_incident" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="date">
                        <small>@error('date_incident') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                    <div class="mb-4 flex-1">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                         Date Recorded
                        </label>
                        <input value="{{ $report->date_recorded }}" name="date_recorded" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="date">
                        <small>@error('date_recorded') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                    </div>
                </div>

              <div class="flex items-center justify-between">
                @csrf
                @method('PATCH')
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                  Update
                </button>
              </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('blotterReports').classList.add('show')
});
</script>
@endsection
