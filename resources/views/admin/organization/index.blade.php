@extends('admin.layouts')
@section('content')
<div class="col-md-12 mb-4">
    <div class="card">
     <div class="card-body text-2xl text-slate-600">
         Barangay Organization
     </div>
    </div>
 </div>
<div class="card">
    <div class="card-body">
        <div class="org-wrapper">
			<div class="org-content">
			 <div class="org-box">
                <div class="org-body org-body-1">
                    @if ($treasurer)
                    <div class="org-size org-treasurer">
                        <div class="org-img-div">
                            @if ($treasurer['picture']=='noimage.jpg')
                            <img class="org-img-thumb" src="{{ asset('images/noimage.jpg') }}">
                            @else
                            <img class="org-img-thumb" src="{{ asset('images/officials/'.$treasurer['picture']) }}">
                            @endif
                        </div>
                         <div>
                             <div class="org-name">{{ $treasurer['name'] }}</div>
                             <div class="org-title">{{ $treasurer['role'] }}</div>
                         </div>
                     </div>
                    @endif
                    @if ($kapitan)
                    <div class="org-size org-kapitan">
                       <div class="org-img-div">
                           @if ($kapitan['picture']=='noimage.jpg')
                           <img class="org-img-thumb" src="{{ asset('images/noimage.jpg') }}">
                           @else
                           <img class="org-img-thumb" src="{{ asset('images/officials/'.$kapitan['picture']) }}">
                           @endif
                       </div>
                        <div>
                           <div class="org-name">{{ $kapitan['name'] }}</div>
                            <div class="org-title">{{$kapitan['role'] }}</div>
                        </div>
                    </div>
                    @endif
                    @if ($secretary)
                    <div class="org-size org-secretary">
                       <div class="org-img-div">
                           @if ($secretary['picture']=='noimage.jpg')
                           <img class="org-img-thumb" src="{{ asset('images/noimage.jpg') }}">
                           @else
                           <img class="org-img-thumb" src="{{ asset('images/officials/'.$secretary['picture']) }}">
                           @endif
                       </div>
                        <div>
                           <div class="org-name">{{ $secretary['name'] }}</div>
                            <div class="org-title">{{ $secretary['role'] }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="org-body org-body-2">
                    <div class="org-center"></div>
                    <div>
                        <div class="org-body-center">
                          @if (isset($kagawads))
                           @foreach ($kagawads as $kagawad)
                               @if ($kagawad['role']=='Kagawad')
                               <div class="org-size org-kagawad">
                                   <div class="org-img-div">
                                       @if ($kagawad['picture']=='noimage.jpg')
                                       <img class="org-img-thumb" src="{{ asset('images/noimage.jpg') }}">
                                       @else
                                       <img class="org-img-thumb" src="{{ asset('images/officials/'.$kagawad['picture']) }}">
                                       @endif
                                   </div>
                                   <div>
                                       <div class="org-name">{{ $kagawad['name'] }}</div>
                                       <div class="org-title">{{ $kagawad['role'] }}</div>
                                   </div>
                               </div>
                               @endif
                           @endforeach
                           @endif
                        </div>
                    </div>
                </div>
			 </div>
		</div>
    </div>
</div>
@endsection
