<div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Upload Stock Prices</h2>

        @if ($message)
            <div
                class="mb-4 p-4 rounded-lg {{ $messageType === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $message }}
            </div>
        @endif

        <form wire:submit.prevent="uploadCsv">
            {{-- <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Upload CSV File
                </label>
                <input type="file" wire:model="csvFile" accept=".csv,.txt"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500">
                @error('csvFile')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror

                <p class="mt-2 text-sm text-gray-500">
                    CSV format: stock, price, date (e.g., "Company Ltd, 14.5, 2019-01-02")
                </p>
            </div> --}}

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Upload CSV File
                </label>

                <label
                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 16a4 4 0 01-.88-7.903A5.002 5.002 0 0115.9 6H16a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500">
                            <span class="font-semibold">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-xs text-gray-400">CSV or TXT files only (max 5MB)</p>
                    </div>
                    <input id="csvFile" type="file" wire:model="csvFile" accept=".csv,.txt" class="hidden" />
                </label>

                @error('csvFile')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror

                <p class="mt-2 text-sm text-gray-500">
                    CSV format: <code class="bg-gray-100 px-1 py-0.5 rounded text-gray-700">stock, price, date</code>
                    (e.g.,
                    <code class="bg-gray-100 px-1 py-0.5 rounded text-gray-700">Company Ltd, 14.5, 2019-01-02</code>)
                </p>
            </div>


            <div wire:loading wire:target="csvFile" class="text-blue-600 text-sm mb-2">
                Preparing file...
            </div>

            <button type="submit" wire:loading.attr="disabled" wire:target="uploadCsv"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 disabled:bg-gray-400">
                <span wire:loading.remove wire:target="uploadCsv">Upload & Process</span>
                <span wire:loading wire:target="uploadCsv">Processing...</span>
            </button>
        </form>
    </div>
</div>
