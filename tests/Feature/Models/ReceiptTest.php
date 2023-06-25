<?php

namespace Tests\Feature\Models;

use App\Models\Receipt;
use Tests\TestCase;
use Tests\WithDb;

class ReceiptTest extends TestCase
{
    use WithDb;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testFillable()
    {
        $attributes = [
            'total_price'              => 108,
            'total_tax'                => 8,
            'total_tax_excluded_price' => 100,
        ];
        $receipt = Receipt::create($attributes);
        $receipt->refresh();

        collect($attributes)
            ->each(fn ($val, $key) => $this->assertSame($val, $receipt->$key));
    }

    public function testCreate()
    {
        $attributes = [
            'total_price'              => 108,
            'total_tax'                => 8,
            'total_tax_excluded_price' => 100,
        ];
        Receipt::create($attributes);
        $receipts = Receipt::get();
        $this->assertSame(1, $receipts->count());
    }

    public function testDelete()
    {
        $attributes = [
            'total_price'              => 108,
            'total_tax'                => 8,
            'total_tax_excluded_price' => 100,
        ];
        $receipt = Receipt::create($attributes);

        $receipt->delete();
        $receipt->refresh();

        $this->assertSoftDeleted($receipt);
    }
}
