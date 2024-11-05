@php
    $web_title = 'Захиалгууд';
@endphp
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="relative h-full w-full rounded-xl bg-white shadow-[0px_0px_0px_1px_rgba(9,9,11,0.07),0px_2px_2px_0px_rgba(9,9,11,0.05)] dark:bg-zinc-900 dark:shadow-[0px_0px_0px_1px_rgba(255,255,255,0.1)] dark:before:pointer-events-none dark:before:absolute dark:before:-inset-px dark:before:rounded-xl dark:before:shadow-[0px_2px_8px_0px_rgba(0,_0,_0,_0.20),_0px_1px_0px_0px_rgba(255,_255,_255,_0.06)_inset]">
                <div
                    class="grid h-full w-full justify-items-center overflow-hidden place-items-start p-6 py-8 sm:p-8 lg:p-12">
                    <div class="w-full min-w-0">
                        <h3
                            class="text-lg/7 font-semibold tracking-[-0.015em] text-zinc-950 sm:text-base/7 dark:text-white">
                            Захиалгууд
                            <a href="{{ route('order-create') }}"
                                class="relative inline-flex float-right items-center justify-center gap-x-2 rounded-lg border text-base/6 font-semibold px-3.5 py-2.5 sm:px-3 sm:py-1.5 sm:text-sm/6 focus:outline-none text-white bg-green-500 dark:bg-zinc-600">
                                Захиалга нэмэх
                            </a>
                        </h3>

                        <div class="mt-6 -mx-6 sm:-mx-8 lg:-mx-12 overflow-x-auto whitespace-nowrap">
                            <div class="inline-block min-w-full align-middle sm:px-8">
                                <table class="min-w-full text-left text-sm/6 text-zinc-950 dark:text-white">
                                    <thead class="text-zinc-500 dark:text-zinc-400">
                                        <tr>
                                            <th class="border-b px-4 py-2 font-medium text-left">№</th>
                                            <th class="border-b px-4 py-2 font-medium text-left">Захиалгын дугаар</th>
                                            <th class="border-b px-4 py-2 font-medium text-left">Нэр</th>
                                            <th class="border-b px-4 py-2 font-medium text-right">Сар</th>
                                            <th class="border-b px-4 py-2 font-medium text-right">Үнэ</th>
                                            <th class="border-b px-4 py-2 font-medium text-right">Төлөв</th>
                                            <th class="border-b px-4 py-2 font-medium text-right">Төлбөр</th>
                                            <th class="border-b px-4 py-2 font-medium text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td class="px-4 py-4 text-zinc-500 dark:text-zinc-400 border-b">
                                                    {{ $orders->currentPage() * $orders->perPage() - $orders->perPage() + $key + 1 }}
                                                </td>
                                                <td class="px-4 py-4 font-medium border-b">
                                                    {{ $order->order_no }}</td>
                                                <td class="px-4 py-4 border-b">
                                                    <a href="{{ route('chapter-list', $order->id) }}">
                                                        <div class="flex items-center gap-2">

                                                            <span class="font-medium">{{ $order->user->name }} ID:
                                                                {{ $order->user->id }}</span>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="px-4 py-4 text-right font-medium border-b">
                                                    {{ $order->month }}</td>
                                                <td class="px-4 py-4 text-right font-medium border-b">
                                                    {{ $order->current_price }}</td>
                                                <td class="px-4 py-4 text-right border-b">
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 rounded-md px-1.5 py-0.5 text-sm/5 font-medium {{ $order->type == 'ongoing' ? 'bg-green-700/90 text-white' : 'bg-lime-400/20 text-lime-700' }} dark:bg-lime-400/10 dark:text-lime-300">
                                                        {{ $order->type == 'premium' ? 'Premium' : 'Энгийн' }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-4 text-right font-medium border-b">
                                                    {{ $order->payment_status == 'paid' ? 'Төлсөн' : 'Төлөөгүй' }}</td>
                                                <td class="px-4 py-4 text-right border-b">
                                                    <div class="relative inline-block text-left">
                                                        <a href="{{ route('order-edit', $order->id) }}"
                                                            class="inline-flex justify-center w-full p-2 text-sm font-medium text-gray-500 bg-white rounded-full hover:bg-gray-100 focus:outline-none">
                                                            <svg class="w-6 h-6" fill="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 7a2 2 0 110-4 2 2 0 010 4zm0 2a2 2 0 110 4 2 2 0 010-4zm0 6a2 2 0 110 4 2 2 0 010-4z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(event) {
            const dropdown = event.target.closest('button')?.nextElementSibling;
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            } else {
                document.querySelectorAll('.hidden').forEach(dropdown => dropdown.classList.add('hidden'));
            }
        });
    </script>
</x-app-layout>
