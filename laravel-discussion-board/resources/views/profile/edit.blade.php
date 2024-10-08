@extends('layouts.app')

@section('content')
<div class="container mx-auto py-5">
    <h1 class="text-4xl font-bold text-center mb-8">Edit Profile for {{ $user->name }}</h1>

    <!-- Success Message -->
    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    <!-- Profile Edit Form -->
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Name Input -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <!-- Email Input -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <!-- Current Password Input -->
        <div class="mb-4">
            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
            <input type="password" name="current_password" id="current_password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <!-- New Password Input -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <!-- Confirm New Password Input -->
        <div class="mb-5">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <!-- Save Changes Button -->
         <form>
        <button type="submit" style="background-color: blue; color: white;" class="font-bold py-2 px-4 rounded hover:bg-blue-500 transition duration-200">Save Changes</button>


    <!-- Delete Account Form -->
    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-5">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white font-bold py-2 px-4 w-small rounded hover:bg-red-500 transition duration-200">Delete Account</button>
    </form>
</div>
@endsection
