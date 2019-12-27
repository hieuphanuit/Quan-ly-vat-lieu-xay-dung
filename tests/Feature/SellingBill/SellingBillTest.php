<?php

namespace Tests\Feature\SellingBill;

use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellingBillTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddSellingBillSuccessTest()
    {
        $user = User::where('role', 4)->first();
        $this->actingAs($user)
            ->json('post', '/api/selling-bill', [
                'total_paid' => '10000',
                'customer_id' => '2',
                'details' => [
                    [
                        'product_id' => 1,
                        'quantity' => 2
                    ]
                ]
            ])
            ->assertStatus(200);
            
    }

    public function testAddSellingBillInvalidTotalPaidProductTest()
    {
        $user = User::where('role', 4)->first();
        $this->actingAs($user)
            ->json('post', '/api/selling-bill', [
                'total_paid' => '100000000',
                'customer_id' => '2',
                'details' => [
                    [
                        'product_id' => 1,
                        'quantity' => 2
                    ]
                ]
            ])
            ->assertStatus(422);
            
    }

    public function testAddSellingBillNotExistProductTest()
    {
        $user = User::where('role', 4)->first();
        $this->actingAs($user)
            ->json('post', '/api/selling-bill', [
                'total_paid' => '10000',
                'customer_id' => '2',
                'details' => [
                    [
                        'product_id' => 100,
                        'quantity' => 2
                    ]
                ]
            ])
            ->assertStatus(422);
            
    }

    // public function testLoginFailTest()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);

    //     $this->json('post', '/api/auth/login', [
    //             'email' => 'hieuminh@gmail.com',
    //             'password' => '12345',
    //         ])
    //         ->assertStatus(401)
    //         ->assertJson([
    //             'error' => 'Unauthorized',
    //         ]);
    // }

    // public function testLoginInvalidDataTest()
    // {
    //     $this->json('post', '/api/auth/login', [
    //             'email' => 'hieuminh@gmail.com',
    //         ])
    //         ->assertStatus(422)
    //         ->assertJsonStructure([
    //             'message',
    //             'errors'
    //         ]);
    // }

}
