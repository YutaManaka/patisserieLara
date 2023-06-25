<?php

namespace Tests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

abstract class ValidationTestCase extends TestCase
{
    abstract protected function baseInput(): array;

    abstract protected function request(): FormRequest;

    abstract protected function formData();

    protected function makeInput(array $input = [], string $exceptKey = null)
    {
        $baseInput = $this->baseInput();

        $input = array_replace($baseInput, $input);
        $input = Arr::except($input, $exceptKey);

        return $input;
    }

    /**
     * Form Validation Test
     *
     * @dataProvider formData
     */
    public function testFormValidation(bool $expected, ...$inputs)
    {
        $request = $this->request();
        $rules   = $request->rules();
        $input   = $this->makeInput(...$inputs);

        $request->merge($input);

        $validator = Validator::make($input, $rules);

        if (method_exists($request, 'withValidator')) {
            $request->withValidator($validator);
        }

        $result = $validator->passes();

        if ($expected !== $result) {
            dump($validator->errors());
        }

        $this->assertEquals($expected, $result);
    }
}
