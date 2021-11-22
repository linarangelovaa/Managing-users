@extends('layouts.app')

@section('header')
    <h4>Create user</h4>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="">
                        <div class="md:px-32 py-8 w-full">
                            {{-- <div class="shadow overflow-hidden rounded border-b border-gray-200"> --}}
                            <form method="POST" action="{{ route('users.store') }}">
                                @csrf

                                <!-- Name -->
                                <div>
                                    <x-label for="name" :value="__('Name')" />

                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('name')" required />
                                </div>

                                <div class="mt-4">
                                    <x-label for="email" :value="__('Email')" />

                                    <x-input id="email" class="block mt-1 w-full" type="text" name="email"
                                        :value="old('email')" required />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password" :value="__('Password')" />

                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                        :value="old('password')" required />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="ml-4">
                                        {{ __('Create') }}
                                    </x-button>
                                </div>
                            </form>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
