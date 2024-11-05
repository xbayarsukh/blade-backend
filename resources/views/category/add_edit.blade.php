@php
    $web_title = isset($category) ? 'Төрөл засах' : 'Төрөл нэмэх';
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
                    action="{{ isset($category) ? route('category-update', $category->id) : route('category-store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h1 class="text-2xl/8 font-semibold text-zinc-950 sm:text-xl/8 dark:text-white">Төрөл
                        {{ isset($category) ? 'засах' : 'нэмэх' }}</h1>
                    <hr role="presentation" class="my-10 mt-6 w-full border-t border-zinc-950/10 dark:border-white/10">
                    <section class="grid gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="space-y-1">
                            <h2 class="text-base/7 font-semibold text-zinc-950 sm:text-sm/6 dark:text-white">
                                Төрөл нэр</h2>
                            <p data-slot="text" class="text-base/6 text-zinc-500 sm:text-sm/6 dark:text-zinc-400">
                                Хэрэглэгчид харагдах Төрлийн нэр.</p>
                        </div>
                        <div><span data-slot="control"
                                class="relative block w-full before:absolute before:inset-px before:rounded-[calc(theme(borderRadius.lg)-1px)] before:bg-white before:shadow dark:before:hidden after:pointer-events-none after:absolute after:inset-0 after:rounded-lg after:ring-inset after:ring-transparent sm:after:focus-within:ring-2 sm:after:focus-within:ring-blue-500 has-[[data-disabled]]:opacity-50 before:has-[[data-disabled]]:bg-zinc-950/5 before:has-[[data-disabled]]:shadow-none before:has-[[data-invalid]]:shadow-red-500/10"><input
                                    aria-label="Organization Name"
                                    class="relative block w-full appearance-none rounded-lg px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] sm:px-[calc(theme(spacing[3])-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] text-base/6 text-zinc-950 placeholder:text-zinc-500 sm:text-sm/6 dark:text-white border border-zinc-950/10 data-[hover]:border-zinc-950/20 dark:border-white/10 dark:data-[hover]:border-white/20 bg-transparent dark:bg-white/5 focus:outline-none data-[invalid]:border-red-500 data-[invalid]:data-[hover]:border-red-500 data-[invalid]:dark:border-red-500 data-[invalid]:data-[hover]:dark:border-red-500 data-[disabled]:border-zinc-950/20 dark:data-[hover]:data-[disabled]:border-white/15 data-[disabled]:dark:border-white/15 data-[disabled]:dark:bg-white/[2.5%] dark:[color-scheme:dark]"
                                    id="headlessui-input-:rq:" data-headlessui-state=""
                                    value="{{ isset($category) ? $category->title : '' }}" name="title"
                                    required></span>
                        </div>
                    </section>
                    <hr role="presentation" class="my-10 w-full border-t border-zinc-950/5 dark:border-white/5">
                    <section class="grid gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="space-y-1">
                            <h2 class="text-base/7 font-semibold text-zinc-950 sm:text-sm/6 dark:text-white">Зураг
                            </h2>
                            <p data-slot="text" class="text-base/6 text-zinc-500 sm:text-sm/6 dark:text-zinc-400">
                                Тухайн Төрлийн зураг</p>
                        </div>
                        <div>
                            <label>
                                <div
                                    class="mb-5 w-full h-11 rounded-3xl border border-gray-300 justify-between items-center inline-flex">
                                    <h2 class="text-gray-900/20 text-sm font-normal leading-snug pl-4">No file chosen
                                    </h2>
                                    <input type="file" name="image" id="imageUpload" hidden
                                        {{ isset($category) ? '' : 'required' }} />
                                    <div
                                        class="flex w-28 h-11 px-2 flex-col bg-indigo-600 rounded-r-3xl shadow text-white text-xs font-semibold leading-4 
                                                                       items-center justify-center cursor-pointer focus:outline-none">
                                        Choose File </div>
                                </div>
                            </label>

                            <div id="preview">
                                {!! isset($category)
                                    ? '<img src="data:image/webp;base64,' . $category->image . '" alt="">'
                                    : 'No image uploaded' !!}
                            </div>
                        </div>
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
                                aria-hidden="true"></span>{{ isset($category) ? 'Хадгалах' : 'Нэмэх' }}</button></div>
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
