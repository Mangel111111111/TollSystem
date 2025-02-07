<header class="bg-blue-900 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
        <h1 class="text-2xl font-bold">
            <a href="{{ route('home') }}">Sistema de Peaje</a>
        </h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="{{ route('stations.index') }}" class="hover:underline">Stations</a></li>
                <li><a href="{{ route('vehicles.index') }}" class="hover:underline">Vehicles</a></li>
                <li><a href="{{ route('records.index') }}" class="hover:underline">Records</a></li>
            </ul>
        </nav>
    </div>
</header>