<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('FW') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Matrícula
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Llegada
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Origen
                        </th>
                        <th scope="col" class="py-3 px-6">
                            STA
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Salida
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Destino
                        </th>
                        <th scope="col" class="py-3 px-6">
                            STD
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($flights as $flight)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-6">
                            {{ $flight->REG }}
                            <input type="hidden" name="REG[]" value="{{ $flight->REG }}" />
                        </td>
                        <td class="py-4 px-6">
                            {{ $flight->Llegada }}
                            <input type="hidden" name="Llegada[]" value="{{ $flight->Llegada }}" />
                        </td>
                        <td class="py-4 px-6">
                            {{ $flight->Origen }}
                            <input type="hidden" name="Origen[]" value="{{ $flight->Origen }}" />
                        </td>
                        <td class="py-4 px-6">
                            {{ $flight->STA }}
                            <input type="hidden" name="STA[]" value="{{ $flight->STA }}" />
                        </td>
                        <td class="py-4 px-6">
                            {{ $flight->FLT }}
                            <input type="hidden" name="FLT[]" value="{{ $flight->FLT }}" />
                        </td>
                        <td class="py-4 px-6">
                            {{ $flight->ARR }}
                            <input type="hidden" name="ARR[]" value="{{ $flight->ARR }}" />
                        </td>
                        <td class="py-4 px-6">
                            {{ $flight->STD }}
                            <input type="hidden" name="STD[]" value="{{ $flight->STD }}" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
