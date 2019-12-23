<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
//        public function testExample()
//        {
//            $this->withoutExceptionHandling();
//            $response = $this->post('/books',[
//               'title'=>"cool book title",
//               'author'=>'victor',
//            ]);
//            $response->assertOk();
//            $this->assertCount(1,Book::all());
//        }
//        public function testValidation()
//        {
////            $this->withoutExceptionHandling();
//            $response = $this->post('/books',[
//                'title'=>"victor title",
//                'author'=>'',
//            ]);
//
//            $response->assertSessionHasErrors('author');
//
//        }
        public function test_book_can_be_updated()
        {
            $this->withoutExceptionHandling();
            $this->post('/books',[
                'title'=>"victor title",
                'author'=>'victor',
            ]);
            $response = $this->patch('/books/'.Book::first()->id,[
              'title'=>'new title',
              'author'=>'sayed',
            ]);

            $this->assertEquals('new title',Book::first()->title);
            $this->assertEquals('sayed',Book::first()->author);
        }
}
