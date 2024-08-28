@extends('admin.layouts')
@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
       <div class="card">
        <div class="card-body text-2xl text-slate-600">
            Barangay Information
        </div>
       </div>
    </div>
    <div class="mb-4">
        @if (Session::has('success'))
        <div class="text-green-600 text-2xl m-3 w-full text-center">
            <p class="">{{ Session::get('success') }}</p>
        </div>
        @endif
     {{-- <div class="flex justify-between">
        @if (auth()->user()->role=='admin')
        <i class="fa fa-trash text-lg bg-red-500 px-2 py-1 cursor-pointer rounded-sm text-white"  data-modal-target="defaultModal" data-modal-toggle="defaultModal"></i>
        @endif
    </div> --}}
    </div>
    <div class="row">
        <div class="col-md-3 mb-3" style="min-width:400px;">
            <div class="card">
                <div class="card-header flex flex-col items-center">
                    @if ($logo!=null)
                    @if ($logo->name)
                        <img class=" w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" style="width: 250px; height:250px;" src="{{ asset('images/logos/'.$logo->name) }}" alt="">
                    @else
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"  style="width: 250px; height:250px;" src="{{ asset('images/noimage.jpg') }}" alt="">
                    @endif
                   @endif
                   <span><a href="{{ route('admin.information.create') }}"><i class="fa fa-edit font-bold"></i> Change Logo</a></span>
                </div>
                <div class="card-body">
                    <div class="py-2 justify-between flex" style="border-bottom: 1px solid rgba(0, 0, 21, 0.175); font-weight:500;">
                        <span>Barangay :</span><span>{{ $logo->barangay->name??'' }}</span>
                    </div>
                    <div class="py-2 justify-between flex" style="border-bottom: 1px solid rgba(0, 0, 21, 0.175); font-weight:500;">
                        <span>Muncipality :</span><span>{{ $logo->barangay->municipal->name??''}}</span>
                    </div>
                    <div class="py-2 justify-between flex" style="border-bottom: 1px solid rgba(0, 0, 21, 0.175); font-weight:500;">
                        <span>Province :</span><span>{{ $logo->barangay->municipal->province->name??'' }}</span>
                    </div>
                    <div class="py-2 justify-between flex" style="border-bottom: 1px solid rgba(0, 0, 21, 0.175); font-weight:500;">
                        <span>Phone :</span><span>{{ $logo->barangay->phone??'' }}</span>
                    </div>
                    <div class="py-2 justify-between flex" style="border-bottom: 1px solid rgba(0, 0, 21, 0.175); font-weight:500;">
                        <span>Email :</span><span>{{ $logo->barangay->email??'' }}</span>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-4 mb-3" style="min-width:400px;">
            <div class="card" style="min-height:530px;">
                <div class="card-header flex flex-col items-center">
                    @if ($background!=null)
                    @if ($background->name)
                        <img class=" w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" style="width: 250px; height:250px;" src="{{ asset('images/background/'.$background->name) }}" alt="">
                    @else
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"  style="width: 250px; height:250px;" src="{{ asset('images/noimage.jpg') }}" alt="">
                    @endif
                   @endif
                   <span><a href="{{ route('admin.background.create') }}"><i class="fa fa-edit font-bold"></i> Change Background</a></span>
                </div>
                <div class="card-body">
                    <div class="py-2 justify-between flex" style="border-bottom: 1px solid rgba(0, 0, 21, 0.175); font-weight:500;">
                        <span>Background :</span><span>{{ $background->title??'' }}</span>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-md-5" style="min-width:400px;">
            <div class="card">
                <div class="card-body my-2">
                    @if ($logo!=null)
                    <form method="POST" action="{{ route('admin.information.update',$logo->barangay->id) }}" class="flex flex-col gap-3">
                        <div class="form-group flex gap-5">
                            <label class="m-2 font-bold flex-1">Barangay</label>
                            <input type="text" class="form-control" name="name" value="{{ $logo->barangay->name??'' }}">
                            <small>@error('name') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                        </div>
                        <div class="form-group flex gap-5">
                            <label class="m-2 font-bold flex-1">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $logo->barangay->phone??'' }}">
                            <small>@error('phone') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                        </div>
                        <div class="form-group flex gap-5">
                            <label class="m-2 font-bold flex-1">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $logo->barangay->email??'' }}">
                            <small>@error('email') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                        </div>
                        <div class="form-group flex gap-5">
                            <label class="m-2 font-bold flex-1">Municipal</label>
                            <input type="text" class="form-control" readonly name="name" disabled value="{{ $logo->barangay->municipal->name??''}}">
                        </div>
                        <div class="form-group flex gap-5">
                            <label class="m-2 font-bold flex-1">Province</label>
                            <input type="text" class="form-control" readonly name="name" disabled value="{{ $logo->barangay->municipal->province->name??'' }}">
                        </div>
                        @if (auth()->user()->role=='admin')
                        <div class="form-group">
                            @csrf
                            @method('PATCH')
                            <button class="bg-green-600 py-2 hover:bg-green-700 px-3  text-white rounded-md" type="submit">Update</button>
                        </div>
                        @endif
                    </form>
                    @else
                    <h3>Need to updated the logo before to show data</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
