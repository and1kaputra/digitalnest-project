@extends('front.layouts.app')
@section('title', 'Digital Nest Marketplace')
@section('content')

<x-navbar :categories="$categories"/>

<div class="flex items-center justify-center h-screen">
    <div class="max-w-lg mx-auto p-6  bg-neutral-300 shadow-lg rounded-lg">
        <div class="flex justify-center">
            <img src="{{ asset('images/protest.png') }}" class="w-64 h-64" alt="Suspend Image">
        </div>
        <h1 class="text-2xl font-bold text-center text-red-600 mt-4">Your account is suspanded!</h1>
        <p class="text-center text-neutral-600 mt-2">For more detailed information, please contact the admin at the following email: support@example.com</p>
        <div class="flex justify-center mt-6">
            <a href="{{ route('front.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back to home</a>
        </div>
    </div>
</div>

<x-footer/>