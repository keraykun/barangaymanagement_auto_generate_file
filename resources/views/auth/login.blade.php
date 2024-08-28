@extends('layout')
@section('content')
<style>
    #mainbefore::before{
        /* content: '';
        width: 100%;
        height: 100%;
        position: absolute;
        background-image: url("{{ asset('images/sagnu.png') }}");
        mix-blend-mode: darken;
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
        opacity: 1;
        z-index: -1; */
    }
</style>

<main id="mainbefore" class="relative min-w-xl min-full flex flex-row justify-center h-screen items-stretch">
    <section class="flex items-center justify-center flex-1 bg-[url('/public/images/blob2.png')] bg-cover bg-no-repeat bg-center">
        <section class="">
            <img src="{{ asset('images/sagnu.png') }}" alt="">
        </section>
    </section>
    <section class="flex-1 bg-[url('/public/images/blob1.png')] bg-cover bg-no-repeat bg-center ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-xl shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        <p class="text-3xl">Barangay Portal</p>
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            @if (Session::has('error'))
                                <p class="text-red-600 text-bold ">{{ Session::get('error') }}</p>
                            @endif
                            @error('email')
                                <p class="text-red-600 text-bold ">{{ $message }}</p>
                            @enderror
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Official Account</label>
                            <input autocomplete="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@email.com">
                        </div>
                        <div>
                            @error('password')
                            <p class="text-red-600 text-bold ">{{ $message }}</p>
                             @enderror
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        <div class="flex items-center justify-between">
                            <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                        </div>
                        <button type="submit" class="w-full text-white bg-green-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
