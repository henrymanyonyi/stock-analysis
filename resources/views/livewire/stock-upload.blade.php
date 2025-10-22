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
            <div class="mb-4">
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
