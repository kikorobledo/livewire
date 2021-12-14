<div>

    <div class="space-y-4">

        <div class="px-8 mx-auto">

            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>

        </div>

        <div class="px-8 mx-auto space-y-2">

            <div class="flex justify-between">

                <div class="w-2/4 flex space-x-2">

                    <x-input.text wire:model="filters.search" placeholder="Search transaction"/>

                    <x-button.link wire:click="toggleShowFilters">@if ($showFilters) Hide @endif Advanced Search...</x-button.link>

                </div>

                <div class="space-x-2 flex items-center">

                    <x-input.group borderless paddingless for="perPage" label="Per Page">

                        <x-input.select wire:model="perPage" id="perPage">

                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>

                        </x-input.select>

                    </x-input.group>

                    <x-dropdown label="Bulk Accions">

                        <x-dropdown.item type="button" class="flex items-center space-x-2" wire:click="exportSelected">

                            <x-icon.download class="text-gray-400"/><span>Export</span>

                        </x-dropdown.item>

                        <x-dropdown.item type="button" class="flex items-center space-x-2" wire:click="$set('showDeleteModal', true)">

                            <x-icon.trash class="text-gray-400" /><span>Delete</span>

                        </x-dropdown.item>

                    </x-dropdown>

                    <livewire:import-transactions />

                    <x-button.primary wire:click="create"><x-icon.plus/>Add</x-button.primary>

                </div>

            </div>

            <div>

                @if ($showFilters)

                    <div class="bg-cool-gray-200 p-4 rounded shadow-inner flex relative">

                        <div class="w-1/2 pr-2 space-y-4">

                            <x-input.group inline for="filter-status" label="Status">

                                <x-input.select wire:model="filters.status" id="filter-status">

                                    <option value="" disabled>Select Status...</option>

                                    @foreach (App\Models\Transaction::STATUSES as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach

                                </x-input.select>

                            </x-input.group>

                            <x-input.group inline for="filter-amount-min" label="Minimum Amount">

                                <x-input.money wire:model.lazy="filters.amount-min" id="filter-amount-min" />

                            </x-input.group>

                            <x-input.group inline for="filter-amount-max" label="Maximum Amount">

                                <x-input.money wire:model.lazy="filters.amount-max" id="filter-amount-max" />

                            </x-input.group>

                        </div>

                        <div class="w-1/2 pl-2 space-y-4">

                            <x-input.group inline for="filter-date-min" label="Minimum Date">

                                <x-input.date wire:model="filters.date-min" id="filter-date-min" placeholder="MM/DD/YYYY" />

                            </x-input.group>

                            <x-input.group inline for="filter-date-max" label="Maximum Date">

                                <x-input.date wire:model="filters.date-max" id="filter-date-max" placeholder="MM/DD/YYYY" />

                            </x-input.group>

                            <x-button.link wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</x-button.link>

                        </div>

                    </div>

                @endif

            </div>

            <div class="py-4">

                <x-table>

                    <x-slot name="head">

                        <x-table.heading class="pr-0 w-8">

                            <x-input.checkbox wire:model="selectPage"/>

                        </x-table.heading>
                        <x-table.heading multi-column wire:click="sortBy('title')" sortable :direction="$sorts['title'] ?? null">Title</x-table.heading>
                        <x-table.heading multi-column wire:click="sortBy('amount')" sortable :direction="$sorts['amount'] ?? null">Amount</x-table.heading>
                        <x-table.heading multi-column wire:click="sortBy('status')" sortable :direction="$sorts['status'] ?? null">Status</x-table.heading>
                        <x-table.heading multi-column wire:click="sortBy('date')" sortable :direction="$sorts['date'] ?? null">Date</x-table.heading>
                        <x-table.heading />

                    </x-slot>

                    <x-slot name="body">

                        @if($selectPage)

                            <x-table.row >

                                <x-table.cell colspan="6" class="bg-gray-200" wire:key="row-message">

                                    @unless ($selectAll)

                                        <div>

                                        <span>You have selected <strong>{{ $selected->count() }}</strong> transactions, do you want to select all <strong>{{ $transactions->total() }}</strong>?</span>

                                            <x-button.link class="ml-2 text-blue-500" wire:click="selectAll">Select all</x-button.link>

                                        </div>

                                    @else

                                        <span>You are currently selecting all <strong>{{ $transactions->total() }}</strong> transactions.</span>

                                    @endunless

                                </x-table.cell>

                            </x-table.row>

                        @endif

                        @forelse ( $transactions as $transaction )

                            <x-table.row wire:loading.class.delay="opacity-40" wire:key="row-{{ $transaction->id }}">

                                <x-table.cell class="pr-0">

                                    <x-input.checkbox wire:model="selected" value="{{ $transaction->id }}" />

                                </x-table.cell>

                                <x-table.cell>

                                    <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">

                                        <x-icon.cash class="text-gray-400"/>

                                        <p class="text-gray-600 truncate">
                                            {{ $transaction->title }}
                                        </p>

                                    </span>

                                </x-table.cell>

                                <x-table.cell>

                                    <span class="text-gray-900 font-medium">${{ $transaction->amount }} </span> USD

                                </x-table.cell>

                                <x-table.cell>

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-{{ $transaction->status_color }}-100 text-{{ $transaction->status_color }}-800 capitalize">
                                        {{ $transaction->status }}
                                    </span>

                                </x-table.cell>

                                <x-table.cell>

                                    {{ $transaction->date_for_humans }}

                                </x-table.cell>

                                <x-table.cell>

                                    <x-button.link wire:click="edit({{ $transaction->id }})">Edit</x-button.link>

                                </x-table.cell>

                            </x-table.row>

                        @empty
                            <x-table.row>

                            <x-table.cell colspan="6">

                                <div class="flex justify-center items-center space-x-2">

                                    <x-icon.inbox class="h-8 w-8 text-gray-400" />

                                    <span class="text-xl text-gray-400 font-medium">No transactions found.</span>

                                </div>

                            </x-table.cell>

                            </x-table.row>

                        @endforelse

                    </x-slot>

                </x-table>

            </div>

        </div>

    </div>

    <div class="px-8 mx-auto">

        {{ $transactions->links() }}

    </div>

    <form wire:submit.prevent="deleteSelected">

        <x-modal.confirmation wire:model.defer="showDeleteModal">

            <x-slot name="title">Delete Transaction</x-slot>

            <x-slot name="content">

                Are you sure you want to delete these transaccions? This action is irreversible.

            </x-slot>

            <x-slot name="footer">

                <x-button.secondary wire:click="$set('showDeleteModal', false)">Close</x-button.secondary>

                <x-button.primary type="submit">Delete</x-button.primary>

            </x-slot>

        </x-modal.confirmation>

    </form>

    <form wire:submit.prevent="save">

        <x-modal.dialog wire:model.defer="showEditModal">

            <x-slot name="title">Edit Transaction</x-slot>

            <x-slot name="content">

                <x-input.group for="title" label="Title" :error="$errors->first('editing.title')">

                    <x-input.text wire:model="editing.title" id="title" placeholder="Title"/>

                </x-input>

                <x-input.group for="amount" label="Amount" :error="$errors->first('editing.amount')">

                    <x-input.money wire:model="editing.amount" id="amount"/>

                </x-input>

                <x-input.group for="status" label="Status" :error="$errors->first('editing.status')">

                    <x-input.select wire:model="editing.status" id="status">

                        @foreach (App\Models\Transaction::STATUSES as $value => $key)

                            <option value="{{ $value }}">{{ $key }}</option>

                        @endforeach

                    </x-input.select>

                </x-input>

                <x-input.group for="date_for_editing" label="Date" :error="$errors->first('editing.date_for_editing')">

                    <x-input.date wire:model="editing.date_for_editing" id="date_for_editing"/>

                </x-input>

            </x-slot>

            <x-slot name="footer">

                <x-button.secondary wire:click="$set('showEditModal', false)">Close</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>

            </x-slot>

        </x-modal.dialog>

    </form>

</div>