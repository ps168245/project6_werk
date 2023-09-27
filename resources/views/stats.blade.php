<head> @vite(['resources/js/chartLine.js','resources/js/chartBar.js'])</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('stats') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <canvas id="myChart" height="100px"></canvas>
                    <script type="text/javascript" >
                       const  _years = JSON.parse('{!! json_encode($years) !!}');
                       const  _months = JSON.parse('{!! json_encode($months) !!}');
                       const _monthsCount = JSON.parse('{!! json_encode($monthsCount) !!}');
                        const _yearsCount = JSON.parse('{!! json_encode($yearsCount) !!}');
                    </script>

                </div>
            </div>
        </div>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
            <canvas id="myChart2"></canvas>
          </div>
                        </div>
                    </div>
                </div>
    </div>






</x-app-layout>
