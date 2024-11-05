@php
    $web_title = 'Захиалгууд';
@endphp
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="relative h-full w-full rounded-xl dark:before:pointer-events-none dark:before:absolute dark:before:-inset-px dark:before:rounded-xl dark:before:shadow-[0px_2px_8px_0px_rgba(0,_0,_0,_0.20),_0px_1px_0px_0px_rgba(255,_255,_255,_0.06)_inset]">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div
                        class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                        <div class="rounded-t mb-0 px-0 border-0">
                            <div class="flex flex-wrap items-center px-4 py-2">
                                <div class="relative w-full max-w-full flex-grow flex-1">
                                    <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Хэрэглэгч</h3>
                                </div>
                            </div>
                            <div class="block w-full overflow-x-auto">
                                <table class="items-center w-full bg-transparent border-collapse">
                                    <tbody>

                                        <tr class="text-gray-700 dark:text-gray-100">
                                            <th
                                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                ID: </th>
                                            <td
                                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {{ $order->user->id }}</td>

                                        </tr>
                                        <tr class="text-gray-700 dark:text-gray-100">
                                            <th
                                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                Нэр</th>
                                            <td
                                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {{ $order->user->name }}</td>

                                        </tr>
                                        <tr class="text-gray-700 dark:text-gray-100">
                                            <th
                                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                Цахим хаяг</th>
                                            <td
                                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {{ $order->user->email }}</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                        <div class="flex justify-between mb-4 items-start">
                            <div class="font-medium">Захиалга</div>

                        </div>
                        <div class="overflow-hidden">
                            <table class="w-full min-w-[540px]">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-4 border-b border-b-gray-50">
                                            <div class="flex items-center">
                                                Захиалгын дугаар
                                            </div>
                                        </td>
                                        <td class="py-2 px-4 border-b border-b-gray-50">
                                            <span
                                                class="text-[13px] font-medium text-gray-400">{{ $order->order_no }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4 border-b border-b-gray-50">
                                            <div class="flex items-center">
                                                Төлбөрийн төлөв
                                            </div>
                                        </td>
                                        <td class="py-2 px-4 border-b border-b-gray-50">
                                            <span
                                                class="text-[13px] font-medium text-gray-400">{{ $order->payment_status == 'paid' ? 'Төлсөн' : 'Төлөөгүй' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4 border-b border-b-gray-50">
                                            <div class="flex items-center">
                                                Төлбөрийн төлөв засах
                                            </div>
                                        </td>
                                        <td class="py-2 px-4 border-b border-b-gray-50">
                                            <select aria-label="Currency" name="membership_id"
                                                onchange="change_payment(this)"
                                                class="relative block w-full appearance-none rounded-lg py-[calc(theme(spacing[2.5])-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] pl-[calc(theme(spacing[3.5])-1px)] pr-[calc(theme(spacing.10)-1px)] sm:pl-[calc(theme(spacing.3)-1px)] sm:pr-[calc(theme(spacing.9)-1px)] [&amp;_optgroup]:font-semibold text-base/6 text-zinc-950 placeholder:text-zinc-500 sm:text-sm/6 dark:text-white dark:*:text-white border border-zinc-950/10 data-[hover]:border-zinc-950/20 dark:border-white/10 dark:data-[hover]:border-white/20 bg-transparent dark:bg-white/5 dark:*:bg-zinc-800 focus:outline-none data-[invalid]:border-red-500 data-[invalid]:data-[hover]:border-red-500 data-[invalid]:dark:border-red-600 data-[invalid]:data-[hover]:dark:border-red-600 data-[disabled]:border-zinc-950/20 data-[disabled]:opacity-100 dark:data-[hover]:data-[disabled]:border-white/15 data-[disabled]:dark:border-white/15 data-[disabled]:dark:bg-white/[2.5%]"
                                                id="headlessui-select-:r1v:" data-headlessui-state="" required>
                                                <option value="" selected="">Үйлчилгээний эрх сонгох</option>
                                                <option value="paid"
                                                    {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Төлсөн
                                                </option>
                                                <option value="unpaid"
                                                    {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Төлөөгүй
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                        <div class="flex justify-between mb-4 items-start">
                            <div class="font-medium">Захиалгын мэдээлэл</div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                            <div class="rounded-md border border-dashed border-gray-200 p-4">
                                <span class="text-gray-400 text-sm">Захиалгын сар</span>
                                <div class="flex items-center mb-0.5">
                                    <div class="text-xl font-semibold">{{ $order->month }}</div>
                                </div>
                            </div>
                            <div class="rounded-md border border-dashed border-gray-200 p-4">
                                <span class="text-gray-400 text-sm">Захиалгын үнэ</span>
                                <div class="flex items-center mb-0.5">
                                    <div class="text-xl font-semibold">{{ $order->current_price }}</div>
                                </div>
                            </div>
                            <div class="rounded-md border border-dashed border-gray-200 p-4">
                                <span class="text-gray-400 text-sm">Захиалгын төлөв</span>
                                <div class="flex items-center mb-0.5">
                                    <div class="text-xl font-semibold" id="payment-text">
                                        {{ $order->payment_status == 'paid' ? 'Төлсөн' : 'Төлөөгүй' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function change_payment(el) {
            $.post('{{ route('order-update') }}', {
                _token: '{{ csrf_token() }}',
                id: "{{ $order->id }}",
                status: el.value
            }, function(data) {
                Toastify({
                    text: data == "paid" ? 'Төлсөн боллоо' : 'Төлөөгүй боллоо',
                    duration: 3000,
                    destination: "#",
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: data == 1 ? "linear-gradient(to right, #00b09b, #96c93d)" :
                            "linear-gradient(to right, red, #96c93d)",
                        borderRadius: "10px",
                    },
                }).showToast();
                $("#payment-text").text(data == "paid" ? "Төлсөн" : "Төлөөгүй");
            });
        }
    </script>
</x-app-layout>
