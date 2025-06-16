@extends('layouts.admin')

@section('title', 'Posyandu Ganggang | Dashboard')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 @csrf
    {{--  Content --}}
    <div class="container">
          <!-- div3 -->
  <div class="bg-gray-100 rounded 2xl md:col-start-1 md:col-end-5 md:row-start-1 md:row-end-3">
    <div class="p-6 flex justify-between items-center h-40">
      <div>
         <h1 class="text-2xl font-semibold mb-1">Selamat datang, {{ Auth::user()->name }}!</h1>
         <p class="text-sm text-gray-700">Semoga harimu menyenangkan dan jangan lupa menjaga kesehatan!</p>
      </div>
      <div>
         <img src="/assets/img/dashboard.png" class="h-40" alt="">
      </div>
   </div>
  </div>
       

    <!-- Flowbite Charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite/dist/flowbite.charts.min.js"></script>
@endsection
