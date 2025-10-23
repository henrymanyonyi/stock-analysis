<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\StockPrice;
use Illuminate\Support\Facades\Auth;

class StockUpload extends Component
{
    use WithFileUploads;

    public $csvFile;
    public $uploading = false;
    public $message = '';
    public $messageType = '';

    protected $rules = [
        'csvFile' => 'required|file|mimes:csv,txt|max:10240',
    ];

    public function uploadCsv()
    {
        $this->validate();
        $this->uploading = true;
        $this->message = '';

        try {
            $path = $this->csvFile->getRealPath();
            $file = fopen($path, 'r');

            // Skip header row
            $header = fgetcsv($file);

            $imported = 0;
            $errors = 0;

            while (($row = fgetcsv($file)) !== false) {
                if (count($row) >= 3) {
                    try {
                        StockPrice::create([
                            'user_id' => Auth::id(),
                            'stock' => trim($row[0]),
                            'price' => floatval($row[1]),
                            'date' => \Carbon\Carbon::parse($row[2])->format('Y-m-d'),
                        ]);
                        $imported++;
                    } catch (\Exception $e) {
                        $errors++;
                    }
                }
            }

            fclose($file);

            $this->message = "Successfully imported {$imported} records.";
            if ($errors > 0) {
                $this->message .= " {$errors} records had errors.";
            }
            $this->messageType = 'success';

            $this->csvFile = null;
            $this->dispatch('stock-uploaded');
        } catch (\Exception $e) {
            $this->message = 'Error processing file: ' . $e->getMessage();
            $this->messageType = 'error';
        }

        $this->uploading = false;

        // reload the page
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.stock-upload');
    }
}
