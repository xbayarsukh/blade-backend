<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="relative h-full w-full rounded-xl bg-white shadow-[0px_0px_0px_1px_rgba(9,9,11,0.07),0px_2px_2px_0px_rgba(9,9,11,0.05)] dark:bg-zinc-900 dark:shadow-[0px_0px_0px_1px_rgba(255,255,255,0.1)] dark:before:pointer-events-none dark:before:absolute dark:before:-inset-px dark:before:rounded-xl dark:before:shadow-[0px_2px_8px_0px_rgba(0,_0,_0,_0.20),_0px_1px_0px_0px_rgba(255,_255,_255,_0.06)_inset] forced-colors:outline">
                <div
                    class="grid h-full w-full justify-items-center overflow-hidden place-items-start p-6 py-8 sm:p-8 lg:p-12">
                    <div class="w-full min-w-0">
                        <h3
                            class="text-lg/7 font-semibold tracking-[-0.015em] text-zinc-950 sm:text-base/7 dark:text-white">
                            Слайд жагсаалт <a href="{{ route('slide-create') }}"
                                class="relative isolate inline-flex items-center justify-center gap-x-2 rounded-lg border text-base/6 font-semibold px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] sm:px-[calc(theme(spacing.3)-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] sm:text-sm/6 focus:outline-none data-[focus]:outline data-[focus]:outline-2 data-[focus]:outline-offset-2 data-[focus]:outline-blue-500 data-[disabled]:opacity-50 [&amp;>[data-slot=icon]]:-mx-0.5 [&amp;>[data-slot=icon]]:my-0.5 [&amp;>[data-slot=icon]]:size-5 [&amp;>[data-slot=icon]]:shrink-0 [&amp;>[data-slot=icon]]:text-[--btn-icon] [&amp;>[data-slot=icon]]:sm:my-1 [&amp;>[data-slot=icon]]:sm:size-4 forced-colors:[--btn-icon:ButtonText] forced-colors:data-[hover]:[--btn-icon:ButtonText] border-transparent bg-[--btn-border] dark:bg-[--btn-bg] before:absolute before:inset-0 before:-z-10 before:rounded-[calc(theme(borderRadius.lg)-1px)] before:bg-[--btn-bg] before:shadow dark:before:hidden dark:border-white/5 after:absolute after:inset-0 after:-z-10 after:rounded-[calc(theme(borderRadius.lg)-1px)] after:shadow-[shadow:inset_0_1px_theme(colors.white/15%)] after:data-[active]:bg-[--btn-hover-overlay] after:data-[hover]:bg-[--btn-hover-overlay] dark:after:-inset-px dark:after:rounded-lg before:data-[disabled]:shadow-none after:data-[disabled]:shadow-none text-white [--btn-bg:theme(colors.green.500)] [--btn-border:theme(colors.green.500/90%)] [--btn-hover-overlay:theme(colors.white/10%)] dark:text-white dark:[--btn-bg:theme(colors.zinc.600)] dark:[--btn-hover-overlay:theme(colors.white/5%)] [--btn-icon:theme(colors.zinc.400)] data-[active]:[--btn-icon:theme(colors.zinc.300)] data-[hover]:[--btn-icon:theme(colors.zinc.300)] cursor-default float-right"
                                data-headlessui-state="hover" data-hover=""><span
                                    class="absolute left-1/2 top-1/2 size-[max(100%,2.75rem)] -translate-x-1/2 -translate-y-1/2 [@media(pointer:fine)]:hidden"
                                    aria-hidden="true"></span>Слайд нэмэх</a>
                        </h3>

                        <div
                            class="mt-6 [--gutter:theme(spacing.6)] sm:[--gutter:theme(spacing.8)] lg:[--gutter:theme(spacing.12)] -mx-[--gutter] overflow-x-auto whitespace-nowrap">
                            <div class="inline-block min-w-full align-middle sm:px-[--gutter]">
                                <table class="min-w-full text-left text-sm/6 text-zinc-950 dark:text-white">
                                    <thead class="text-zinc-500 dark:text-zinc-400">
                                        <tr class="">
                                            <th
                                                class="border-b border-b-zinc-950/10 px-4 py-2 font-medium first:pl-[var(--gutter,theme(spacing.2))] last:pr-[var(--gutter,theme(spacing.2))] dark:border-b-white/10 sm:first:pl-1 sm:last:pr-1">
                                                №</th>
                                            <th
                                                class="border-b border-b-zinc-950/10 px-4 py-2 font-medium first:pl-[var(--gutter,theme(spacing.2))] last:pr-[var(--gutter,theme(spacing.2))] dark:border-b-white/10 sm:first:pl-1 sm:last:pr-1">
                                                Зураг</th>
                                            <th
                                                class="text-right border-b border-b-zinc-950/10 px-4 py-2 font-medium first:pl-[var(--gutter,theme(spacing.2))] last:pr-[var(--gutter,theme(spacing.2))] dark:border-b-white/10 sm:first:pl-1 sm:last:pr-1">
                                                Манга Нэр
                                            </th>
                                            <th
                                                class="text-right border-b border-b-zinc-950/10 px-4 py-2 font-medium first:pl-[var(--gutter,theme(spacing.2))] last:pr-[var(--gutter,theme(spacing.2))] dark:border-b-white/10 sm:first:pl-1 sm:last:pr-1">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($slides as $key => $slide)
                                            <tr class="">
                                                <td
                                                    class="text-zinc-500 dark:text-zinc-400 relative px-4 first:pl-[var(--gutter,theme(spacing.2))] last:pr-[var(--gutter,theme(spacing.2))] border-b border-zinc-950/5 dark:border-white/5 py-4 sm:first:pl-1 sm:last:pr-1">
                                                    {{ $slides->currentPage() * $slides->perPage() - $slides->perPage() + $key + 1 }}
                                                </td>
                                                <td
                                                    class="relative px-4 first:pl-[var(--gutter,theme(spacing.2))] last:pr-[var(--gutter,theme(spacing.2))] border-b border-zinc-950/5 dark:border-white/5 py-4 sm:first:pl-1 sm:last:pr-1">
                                                    <div class="flex items-center gap-2"><span data-slot="avatar"
                                                            class="relative size-8 inline-grid shrink-0 align-middle [--avatar-radius:40%] [--ring-opacity:40%] *:col-start-1 *:row-start-1 outline outline-1 -outline-offset-1 outline-black/[--ring-opacity] dark:outline-white/[--ring-opacity] rounded-full *:rounded-full"><img
                                                                class="size-full"
                                                                style="width: 32px !important; height:32px !important"
                                                                src="data:image/webp;base64,{{ $slide->image }}"
                                                                alt=""></span>
                                                    </div>
                                                </td>
                                                <td
                                                    class="text-right font-medium relative px-4 first:pl-[var(--gutter,theme(spacing.2))] last:pr-[var(--gutter,theme(spacing.2))] border-b border-zinc-950/5 dark:border-white/5 py-4 sm:first:pl-1 sm:last:pr-1">
                                                    {{ $slide->manga->title ?? 'Устсан манга' }}</td>
                                                <td
                                                    class="text-right relative px-4 first:pl-[var(--gutter,theme(spacing.2))] last:pr-[var(--gutter,theme(spacing.2))] border-b border-zinc-950/5 dark:border-white/5 py-4 sm:first:pl-1 sm:last:pr-1">
                                                    <div class="relative inline-block text-left">

                                                        <button type="button"
                                                            class="inline-flex justify-center w-full p-2 text-sm font-medium text-gray-500 bg-white rounded-full hover:bg-gray-100 focus:outline-none"
                                                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                                                            <svg class="w-6 h-6" fill="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 7a2 2 0 110-4 2 2 0 010 4zm0 2a2 2 0 110 4 2 2 0 010-4zm0 6a2 2 0 110 4 2 2 0 010-4z" />
                                                            </svg>
                                                        </button>


                                                        <!-- Dropdown panel -->
                                                        <div class="absolute right-0 z-10 mt-2 bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden"
                                                            id="dropdown-menu" role="menu"
                                                            aria-orientation="vertical" aria-labelledby="menu-button"
                                                            tabindex="-1">
                                                            <div class="py-1" role="none">
                                                                <a href="{{ route('slide-edit', $slide->id) }}"
                                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                                    role="menuitem">Засах</a>
                                                                <form action="{{ route('slide-delete', $slide->id) }}"
                                                                    method="POST"
                                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                                    role="menuitem"
                                                                    onsubmit="return confirm('Та устгахдаа итгэлтэй байна уу?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="w-full text-left">Устгах</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
