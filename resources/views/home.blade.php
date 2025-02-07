<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Toll System')</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="w-full">
    <div id="index">
        <x-header />
        <main class="bg-[url('https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80')]
                      sm:bg-[url('https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80')]
                      bg-fixed bg-no-repeat bg-cover">
            @yield('content')

            <div class="overflow-x-auto py-8 px-4">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Station</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Vehicle</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Amount</th>
                        </tr>
                    </thead>
                    <tbody id="record-tbody">
                    </tbody>
                </table>
            </div>

            @yield('script')
        </main>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('/apiIndexRecords')
                    .then(response => response.json())
                    .then(records => {
                        const tableBody = document.getElementById('record-tbody');
                        tableBody.innerHTML = '';
        
                        records.forEach(record => {
                            const row = document.createElement('tr');
                            row.classList.add('border-b', 'hover:bg-gray-50');
                            
                            row.innerHTML = `
                                <td class="px-4 py-2 text-sm text-gray-700">${record.id}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">${record.station.name}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">${record.vehicle.plate_number}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">$${record.amount}</td>
                            `;
                            
                            tableBody.appendChild(row);
                        });
                    })
                    .catch(error => console.error('Error loading records:', error));
            });
        </script>

        <x-footer />
    </div>
</body>
</html>