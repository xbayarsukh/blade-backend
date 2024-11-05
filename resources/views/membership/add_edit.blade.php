@php
    $web_title = isset($membership) ? 'Үйлчилгээний эрх засах' : 'Үйлчилгээний эрх нэмэх';
@endphp
<x-app-layout>
    <style>
        #preview {
            width: 200px;
            height: 200px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #preview img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto max-w-6xl">
                <form method="post" class="mx-auto max-w-5xl"
                    action="{{ isset($membership) ? route('membership-update', $membership->id) : route('membership-store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h1 class="text-2xl/8 font-semibold text-zinc-950 sm:text-xl/8 dark:text-white">Үйлчилгээний эрх
                        {{ isset($membership) ? 'засах' : 'нэмэх' }}</h1>

                    <hr role="presentation" class="my-10 mt-6 w-full border-t border-zinc-950/10 dark:border-white/10">
                    <section class="grid gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="space-y-1">
                            <h2 class="text-base/7 font-semibold text-zinc-950 sm:text-sm/6 dark:text-white">
                                Үйлчилгээний эрх нэр</h2>
                            <p data-slot="text" class="text-base/6 text-zinc-500 sm:text-sm/6 dark:text-zinc-400">
                                Хэрэглэгчид харагдах Үйлчилгээний эрхийн нэр.</p>
                        </div>
                        <div><span data-slot="control"
                                class="relative block w-full before:absolute before:inset-px before:rounded-[calc(theme(borderRadius.lg)-1px)] before:bg-white before:shadow dark:before:hidden after:pointer-events-none after:absolute after:inset-0 after:rounded-lg after:ring-inset after:ring-transparent sm:after:focus-within:ring-2 sm:after:focus-within:ring-blue-500 has-[[data-disabled]]:opacity-50 before:has-[[data-disabled]]:bg-zinc-950/5 before:has-[[data-disabled]]:shadow-none before:has-[[data-invalid]]:shadow-red-500/10"><input
                                    aria-label="Organization Name"
                                    class="relative block w-full appearance-none rounded-lg px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] sm:px-[calc(theme(spacing[3])-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] text-base/6 text-zinc-950 placeholder:text-zinc-500 sm:text-sm/6 dark:text-white border border-zinc-950/10 data-[hover]:border-zinc-950/20 dark:border-white/10 dark:data-[hover]:border-white/20 bg-transparent dark:bg-white/5 focus:outline-none data-[invalid]:border-red-500 data-[invalid]:data-[hover]:border-red-500 data-[invalid]:dark:border-red-500 data-[invalid]:data-[hover]:dark:border-red-500 data-[disabled]:border-zinc-950/20 dark:data-[hover]:data-[disabled]:border-white/15 data-[disabled]:dark:border-white/15 data-[disabled]:dark:bg-white/[2.5%] dark:[color-scheme:dark]"
                                    id="headlessui-input-:rq:" data-headlessui-state=""
                                    value="{{ isset($membership) ? $membership->title : '' }}" name="title"
                                    required></span>
                        </div>
                    </section>
                    <hr role="presentation" class="my-10 w-full border-t border-zinc-950/5 dark:border-white/5">
                    <section class="grid gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="space-y-1">
                            <h2 class="text-base/7 font-semibold text-zinc-950 sm:text-sm/6 dark:text-white">
                                Дэлгэрэнгүй</h2>
                            <p data-slot="text" class="text-base/6 text-zinc-500 sm:text-sm/6 dark:text-zinc-400">
                                Тухайн
                                Үйлчилгээний эрхийн талаар тайлбар</p>
                        </div>
                        <div><span data-slot="control"
                                class="relative block w-full before:absolute before:inset-px before:rounded-[calc(theme(borderRadius.lg)-1px)] before:bg-white before:shadow dark:before:hidden after:pointer-events-none after:absolute after:inset-0 after:rounded-lg after:ring-inset after:ring-transparent sm:after:focus-within:ring-2 sm:after:focus-within:ring-blue-500 has-[[data-disabled]]:opacity-50 before:has-[[data-disabled]]:bg-zinc-950/5 before:has-[[data-disabled]]:shadow-none">
                                <textarea aria-label="Organization Bio" name="description"
                                    class="relative block h-full w-full appearance-none rounded-lg px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] sm:px-[calc(theme(spacing.3)-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] text-base/6 text-zinc-950 placeholder:text-zinc-500 sm:text-sm/6 dark:text-white border border-zinc-950/10 data-[hover]:border-zinc-950/20 dark:border-white/10 dark:data-[hover]:border-white/20 bg-transparent dark:bg-white/5 focus:outline-none data-[invalid]:border-red-500 data-[invalid]:data-[hover]:border-red-500 data-[invalid]:dark:border-red-600 data-[invalid]:data-[hover]:dark:border-red-600 disabled:border-zinc-950/20 disabled:dark:border-white/15 disabled:dark:bg-white/[2.5%] dark:data-[hover]:disabled:border-white/15 resize-y"
                                    id="headlessui-textarea-:rr:" data-headlessui-state="" required>{{ isset($membership) ? $membership->description : '' }}</textarea>
                            </span></div>
                    </section>
                    <hr role="presentation" class="my-10 w-full border-t border-zinc-950/5 dark:border-white/5">
                    <section class="grid gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="space-y-1">
                            <h2 class="text-base/7 font-semibold text-zinc-950 sm:text-sm/6 dark:text-white">
                                Сар</h2>
                            <p data-slot="text" class="text-base/6 text-zinc-500 sm:text-sm/6 dark:text-zinc-400">
                                Тухайн
                                Үйлчилгээний эрхийг авахад нэмэгдэх сар</p>
                        </div>
                        <div class="space-y-4"><span data-slot="control"
                                class="relative block w-full before:absolute before:inset-px before:rounded-[calc(theme(borderRadius.lg)-1px)] before:bg-white before:shadow dark:before:hidden after:pointer-events-none after:absolute after:inset-0 after:rounded-lg after:ring-inset after:ring-transparent sm:after:focus-within:ring-2 sm:after:focus-within:ring-blue-500 has-[[data-disabled]]:opacity-50 before:has-[[data-disabled]]:bg-zinc-950/5 before:has-[[data-disabled]]:shadow-none before:has-[[data-invalid]]:shadow-red-500/10">
                                <select aria-label="Currency" name="month"
                                    class="relative block w-full appearance-none rounded-lg py-[calc(theme(spacing[2.5])-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] pl-[calc(theme(spacing[3.5])-1px)] pr-[calc(theme(spacing.10)-1px)] sm:pl-[calc(theme(spacing.3)-1px)] sm:pr-[calc(theme(spacing.9)-1px)] [&amp;_optgroup]:font-semibold text-base/6 text-zinc-950 placeholder:text-zinc-500 sm:text-sm/6 dark:text-white dark:*:text-white border border-zinc-950/10 data-[hover]:border-zinc-950/20 dark:border-white/10 dark:data-[hover]:border-white/20 bg-transparent dark:bg-white/5 dark:*:bg-zinc-800 focus:outline-none data-[invalid]:border-red-500 data-[invalid]:data-[hover]:border-red-500 data-[invalid]:dark:border-red-600 data-[invalid]:data-[hover]:dark:border-red-600 data-[disabled]:border-zinc-950/20 data-[disabled]:opacity-100 dark:data-[hover]:data-[disabled]:border-white/15 data-[disabled]:dark:border-white/15 data-[disabled]:dark:bg-white/[2.5%]"
                                    id="headlessui-select-:r1v:" data-headlessui-state="" required>
                                    <option value="" selected="">Сар сонгох сонгох</option>
                                    <option value="1"
                                        {{ isset($membership) && $membership->month == '1' ? 'selected' : '' }}>
                                        1 сар
                                    </option>
                                    <option value="2"
                                        {{ isset($membership) && $membership->month == '2' ? 'selected' : '' }}>
                                        2 сар
                                    </option>
                                    <option value="3"
                                        {{ isset($membership) && $membership->month == '3' ? 'selected' : '' }}>
                                        3 сар
                                    </option>
                                    <option value="4"
                                        {{ isset($membership) && $membership->month == '4' ? 'selected' : '' }}>
                                        4 сар
                                    </option>
                                    <option value="5"
                                        {{ isset($membership) && $membership->month == '5' ? 'selected' : '' }}>
                                        5 сар
                                    </option>
                                    <option value="6"
                                        {{ isset($membership) && $membership->month == '6' ? 'selected' : '' }}>
                                        6 сар
                                    </option>
                                    <option value="7"
                                        {{ isset($membership) && $membership->month == '7' ? 'selected' : '' }}>
                                        7 сар
                                    </option>
                                    <option value="8"
                                        {{ isset($membership) && $membership->month == '8' ? 'selected' : '' }}>
                                        8 сар
                                    </option>
                                    <option value="9"
                                        {{ isset($membership) && $membership->month == '9' ? 'selected' : '' }}>
                                        9 сар
                                    </option>
                                    <option value="10"
                                        {{ isset($membership) && $membership->month == '10' ? 'selected' : '' }}>
                                        10 сар
                                    </option>
                                    <option value="11"
                                        {{ isset($membership) && $membership->month == '11' ? 'selected' : '' }}>
                                        11 сар
                                    </option>
                                    <option value="12"
                                        {{ isset($membership) && $membership->month == '12' ? 'selected' : '' }}>
                                        12 сар
                                    </option>
                                </select>
                            </span>
                        </div>
                    </section>
                    <hr role="presentation" class="my-10 w-full border-t border-zinc-950/5 dark:border-white/5">
                    <section class="grid gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="space-y-1">
                            <h2 class="text-base/7 font-semibold text-zinc-950 sm:text-sm/6 dark:text-white">
                                Үнэ</h2>
                            <p data-slot="text" class="text-base/6 text-zinc-500 sm:text-sm/6 dark:text-zinc-400">
                                Тухайн
                                Үйлчилгээний эрхийг авах үнэ</p>
                        </div>
                        <div class="space-y-4"><span data-slot="control"
                                class="relative block w-full before:absolute before:inset-px before:rounded-[calc(theme(borderRadius.lg)-1px)] before:bg-white before:shadow dark:before:hidden after:pointer-events-none after:absolute after:inset-0 after:rounded-lg after:ring-inset after:ring-transparent sm:after:focus-within:ring-2 sm:after:focus-within:ring-blue-500 has-[[data-disabled]]:opacity-50 before:has-[[data-disabled]]:bg-zinc-950/5 before:has-[[data-disabled]]:shadow-none before:has-[[data-invalid]]:shadow-red-500/10"><input
                                    aria-label="Organization Email"
                                    class="relative block w-full appearance-none rounded-lg px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] sm:px-[calc(theme(spacing[3])-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] text-base/6 text-zinc-950 placeholder:text-zinc-500 sm:text-sm/6 dark:text-white border border-zinc-950/10 data-[hover]:border-zinc-950/20 dark:border-white/10 dark:data-[hover]:border-white/20 bg-transparent dark:bg-white/5 focus:outline-none data-[invalid]:border-red-500 data-[invalid]:data-[hover]:border-red-500 data-[invalid]:dark:border-red-500 data-[invalid]:data-[hover]:dark:border-red-500 data-[disabled]:border-zinc-950/20 dark:data-[hover]:data-[disabled]:border-white/15 data-[disabled]:dark:border-white/15 data-[disabled]:dark:bg-white/[2.5%] dark:[color-scheme:dark]"
                                    id="headlessui-input-:rs:" data-headlessui-state="" type="number"
                                    value="{{ isset($membership) ? $membership->price : '' }}" name="price"
                                    required></span>
                        </div>
                    </section>
                    <hr role="presentation" class="my-10 w-full border-t border-zinc-950/5 dark:border-white/5">
                    <section class="grid gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="space-y-1">
                            <h2 class="text-base/7 font-semibold text-zinc-950 sm:text-sm/6 dark:text-white">Төлөв
                            </h2>
                            <p data-slot="text" class="text-base/6 text-zinc-500 sm:text-sm/6 dark:text-zinc-400">
                                Тухайн Үйлчилгээний эрхийн төлөв</p>
                        </div>
                        <div><span data-slot="control"
                                class="group relative block w-full before:absolute before:inset-px before:rounded-[calc(theme(borderRadius.lg)-1px)] before:bg-white before:shadow dark:before:hidden after:pointer-events-none after:absolute after:inset-0 after:rounded-lg after:ring-inset after:ring-transparent after:has-[[data-focus]]:ring-2 after:has-[[data-focus]]:ring-blue-500 has-[[data-disabled]]:opacity-50 before:has-[[data-disabled]]:bg-zinc-950/5 before:has-[[data-disabled]]:shadow-none"><select
                                    aria-label="Currency" name="type"
                                    class="relative block w-full appearance-none rounded-lg py-[calc(theme(spacing[2.5])-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] pl-[calc(theme(spacing[3.5])-1px)] pr-[calc(theme(spacing.10)-1px)] sm:pl-[calc(theme(spacing.3)-1px)] sm:pr-[calc(theme(spacing.9)-1px)] [&amp;_optgroup]:font-semibold text-base/6 text-zinc-950 placeholder:text-zinc-500 sm:text-sm/6 dark:text-white dark:*:text-white border border-zinc-950/10 data-[hover]:border-zinc-950/20 dark:border-white/10 dark:data-[hover]:border-white/20 bg-transparent dark:bg-white/5 dark:*:bg-zinc-800 focus:outline-none data-[invalid]:border-red-500 data-[invalid]:data-[hover]:border-red-500 data-[invalid]:dark:border-red-600 data-[invalid]:data-[hover]:dark:border-red-600 data-[disabled]:border-zinc-950/20 data-[disabled]:opacity-100 dark:data-[hover]:data-[disabled]:border-white/15 data-[disabled]:dark:border-white/15 data-[disabled]:dark:bg-white/[2.5%]"
                                    id="headlessui-select-:r1v:" data-headlessui-state="" required>
                                    <option value="" selected="">Төлөв сонгох</option>
                                    <option value="month"
                                        {{ isset($membership) && $membership->type == 'month' ? 'selected' : '' }}>
                                        Энгийн
                                    </option>
                                    <option value="premium"
                                        {{ isset($membership) && $membership->type == 'premium' ? 'selected' : '' }}>
                                        Premium
                                    </option>
                                </select></span></div>
                    </section>
                    <hr role="presentation" class="my-10 w-full border-t border-zinc-950/5 dark:border-white/5">

                    <div class="flex justify-end gap-4"><button type="reset"
                            class="relative isolate inline-flex items-center justify-center gap-x-2 rounded-lg border text-base/6 font-semibold px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] sm:px-[calc(theme(spacing.3)-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] sm:text-sm/6 focus:outline-none data-[focus]:outline data-[focus]:outline-2 data-[focus]:outline-offset-2 data-[focus]:outline-blue-500 data-[disabled]:opacity-50 [&amp;>[data-slot=icon]]:-mx-0.5 [&amp;>[data-slot=icon]]:my-0.5 [&amp;>[data-slot=icon]]:size-5 [&amp;>[data-slot=icon]]:shrink-0 [&amp;>[data-slot=icon]]:text-[--btn-icon] [&amp;>[data-slot=icon]]:sm:my-1 [&amp;>[data-slot=icon]]:sm:size-4 forced-colors:[--btn-icon:ButtonText] forced-colors:data-[hover]:[--btn-icon:ButtonText] border-transparent text-zinc-950 data-[active]:bg-zinc-950/5 data-[hover]:bg-zinc-950/5 dark:text-white dark:data-[active]:bg-white/10 dark:data-[hover]:bg-white/10 [--btn-icon:theme(colors.zinc.500)] data-[active]:[--btn-icon:theme(colors.zinc.700)] data-[hover]:[--btn-icon:theme(colors.zinc.700)] dark:[--btn-icon:theme(colors.zinc.500)] dark:data-[active]:[--btn-icon:theme(colors.zinc.400)] dark:data-[hover]:[--btn-icon:theme(colors.zinc.400)] cursor-default"
                            data-headlessui-state=""><span
                                class="absolute left-1/2 top-1/2 size-[max(100%,2.75rem)] -translate-x-1/2 -translate-y-1/2 [@media(pointer:fine)]:hidden"
                                aria-hidden="true"></span>Цэвэрлэх</button><button type="submit"
                            class="relative isolate inline-flex items-center justify-center gap-x-2 rounded-lg border text-base/6 font-semibold px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] sm:px-[calc(theme(spacing.3)-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] sm:text-sm/6 focus:outline-none data-[focus]:outline data-[focus]:outline-2 data-[focus]:outline-offset-2 data-[focus]:outline-blue-500 data-[disabled]:opacity-50 [&amp;>[data-slot=icon]]:-mx-0.5 [&amp;>[data-slot=icon]]:my-0.5 [&amp;>[data-slot=icon]]:size-5 [&amp;>[data-slot=icon]]:shrink-0 [&amp;>[data-slot=icon]]:text-[--btn-icon] [&amp;>[data-slot=icon]]:sm:my-1 [&amp;>[data-slot=icon]]:sm:size-4 forced-colors:[--btn-icon:ButtonText] forced-colors:data-[hover]:[--btn-icon:ButtonText] border-transparent bg-[--btn-border] dark:bg-[--btn-bg] before:absolute before:inset-0 before:-z-10 before:rounded-[calc(theme(borderRadius.lg)-1px)] before:bg-[--btn-bg] before:shadow dark:before:hidden dark:border-white/5 after:absolute after:inset-0 after:-z-10 after:rounded-[calc(theme(borderRadius.lg)-1px)] after:shadow-[shadow:inset_0_1px_theme(colors.white/15%)] after:data-[active]:bg-[--btn-hover-overlay] after:data-[hover]:bg-[--btn-hover-overlay] dark:after:-inset-px dark:after:rounded-lg before:data-[disabled]:shadow-none after:data-[disabled]:shadow-none text-white [--btn-bg:theme(colors.zinc.900)] [--btn-border:theme(colors.zinc.950/90%)] [--btn-hover-overlay:theme(colors.white/10%)] dark:text-white dark:[--btn-bg:theme(colors.zinc.600)] dark:[--btn-hover-overlay:theme(colors.white/5%)] [--btn-icon:theme(colors.zinc.400)] data-[active]:[--btn-icon:theme(colors.zinc.300)] data-[hover]:[--btn-icon:theme(colors.zinc.300)] cursor-default"
                            data-headlessui-state=""><span
                                class="absolute left-1/2 top-1/2 size-[max(100%,2.75rem)] -translate-x-1/2 -translate-y-1/2 [@media(pointer:fine)]:hidden"
                                aria-hidden="true"></span>{{ isset($membership) ? 'Хадгалах' : 'Нэмэх' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#imageUpload').on('change', function() {
            var file = this.files[0];

            if (file) {
                var reader = new FileReader();
                console.log(event.target.result);

                reader.onload = function(event) {
                    $('#preview').html('<img src="' + event.target.result + '" alt="Image Preview">');
                };
                reader.readAsDataURL(file);
            } else {
                $('#preview').html('No image uploaded');
            }
        });
    </script>
</x-app-layout>
