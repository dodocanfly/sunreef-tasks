<?php

namespace Dodocanfly\SunreefTasks\Task4;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;


/**
 * Jeśli divisor istnieje, to poniższe warunki nie do spełnienia, ponieważ nie ma
 * możliwości, żeby divisor był większy od sumy arrayDivident, a jednocześnie żeby
 * ta suma była podzielna przez divisor.
 *
 * - arrayDivident – większe lub równe 0 i mniejsze od 1000. Suma mniejsza od 1000
 * i podzielna przez divisor (jeżeli istnieje divisor),
 * - divisor – większe od 0 i mniejsze od 1000, większe od sumy arrayDivident
 */

/**
 * Rozumiem, że głównie chodziło o laravelowe reguły walidacji,
 * a mniej istotne jest to, że nijak w funkcji do stestowania
 * nie obsługujemy błędów
 */
class SunReefValidator
{
    private static function laravelValidator(): Factory
    {
        $filesystem = new Filesystem();
        $fileLoader = new FileLoader($filesystem, '');
        $translator = new Translator($fileLoader, 'pl_PL');
        return new Factory($translator);
    }

    public static function valid(array $data): bool
    {
        $validator = self::laravelValidator()->make($data, [

            # wszystkie liczby powinny być naturalne
            'arrayDivident' => ['required', 'array'], # tablica z liczbami
            'arrayDivident.*' => ['required', 'int', 'min:0', 'max:999'], # większe lub równe 0 i mniejsze od 1000
            'divisor' => ['nullable', 'int', 'min:1', 'max:999'], # większe od 0 i mniejsze od 1000
            'square' => ['required', 'int', 'min:1', 'max:999'], # większe od 0 i mniejsze od 1000
            'power' => ['nullable', 'int', 'min:2', 'max:10'], # większe lub równe 2 i mniejsze lub równe 10

        ]);

        if ($validator->fails()) return false;

        $validator->after(function (Validator $validator) {

            $data = $validator->getData();
            $arrayDividentSum = array_sum($data['arrayDivident']);

            # arrayDivident - Suma mniejsza od 1000
            if (!($arrayDividentSum < 1000)) {
                $validator->errors()->add('arrayDivident', 'Sum of arrayDivident is too large');
            }

            # jeżeli istnieje divisor
            if (array_key_exists('divisor', $data) && $data['divisor']) {

                # arrayDivident - Suma podzielna przez divisor
                if ($arrayDividentSum % $data['divisor']) {
                    $validator->errors()->add('arrayDivident', 'Sum of arrayDivident is not divisible by divisor');
                }

                # divisor większe od sumy arrayDivident
                if (!($data['divisor'] > $arrayDividentSum)) {
                    $validator->errors()->add('divisor', 'Divisor is not greater than sum of arrayDivident');
                }
            }

            # jeżeli nie ma power to potęga o wartości 2
            if (!array_key_exists('power', $data)) {
                $power = 2;
            } else {
                $power = $data['power'] ?? 2;
            }
            $nthRoot = $data['square'] ** (1 / $power);
            # po spierwiastkowaniu do potęgi power daje wynik całkowity
            if (!($nthRoot == (int)$nthRoot)) {
                $validator->errors()->add('square', 'Nth root of `square` is not integer');
            }
        });

        return !$validator->fails();
    }
}