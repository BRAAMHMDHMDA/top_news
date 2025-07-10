<?php

namespace TomatoPHP\FilamentTranslations\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Spatie\TranslationLoader\LanguageLine;

class TranslationsImport implements ToCollection
{
    public function collection(Collection $rows): void
    {
        unset($rows[0]); // Skip header row
        $langs = config('filament-translations.locals');

        foreach ($rows as $key => $row) {
            $id = $row[0];
            $getTranslation = LanguageLine::find($id);

            // Check if the record exists
            if ($getTranslation) {
                $mergeTranslation = [];
                $count = 1;
                foreach ($langs as $langKey => $lang) {
                    if (isset($row[$count + 1]) && !empty($row[$count + 1])) {
                        $mergeTranslation[$langKey] = $row[$count + 1];
                    }
                    $count++;
                }
                $getTranslation->text = $mergeTranslation;
                $getTranslation->save();
            } else {
                $mergeTranslation = [];
                $count = 1;
                foreach ($langs as $langKey => $lang) {
                    if (isset($row[$count + 1]) && !empty($row[$count + 1])) {
                        $mergeTranslation[$langKey] = $row[$count + 1];
                    }
                    $count++;
                }

                LanguageLine::create([
                    'id' => $id,
                    'group' => '*',
                    'key' => $row[1],
                    'text' => $mergeTranslation,
                ]);

                // Log a warning instead of throwing an error
                \Log::warning("Translation with id {$id} not found in the database.");
            }
        }
    }
//    public function collection(Collection $rows)
//    {
//        unset($rows[0]);
//        $getLocals = config('filament-translations.locals');
//
//        foreach ($rows as $key => $row) {
//            $langs = config('filament-translations.locals');
//            $id = $row[0];
//            $getTranslation = LanguageLine::find($id);
//            $mergeTranslation = [];
//            $count = 1;
//            foreach ($langs as $langKey => $lang) {
//                if (isset($row[$count + 1]) && ! empty($row[$count + 1])) {
//                    $mergeTranslation[$langKey] = $row[$count + 1];
//                }
//                $count++;
//            }
//            $getTranslation->text = $mergeTranslation;
//            $getTranslation->save();
//        }
//    }
}
