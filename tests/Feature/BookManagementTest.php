<?php

namespace Tests\Feature;

use App\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
        public function testExample()
        {
            $this->withoutExceptionHandling();
            $response = $this->post('/books', $this->data());
//            $response->assertOk();
            $this->assertCount(1,Book::all());
            $response->assertRedirect(Book::first()->fresh()->path());
        }
        public function testValidation()
        {
//            $this->withoutExceptionHandling();
            $response = $this->post('/books',array_merge($this->data(),['author_id'=>'']));

            $response->assertSessionHasErrors('author_id');

        }
        public function test_book_can_be_updated()
        {
            $this->withoutExceptionHandling();
            $this->post('/books',$this->data());
            $response = $this->patch(Book::first()->path(),[
              'title'=>'new title',
              'author_id'=>'sayed',
            ]);

            $this->assertEquals('new title',Book::first()->title);
            $this->assertEquals(4,Book::first()->author_id);
            $response->assertRedirect(Book::first()->fresh()->path());
        }
        public function test_book_can_be_deleted(){

            $this->withoutExceptionHandling();
            $this->post('/books',[
                'title'=>"victor title",
                'author_id'=>'victor',
            ]);
            $this->assertCount(1,Book::all());
            $response = $this->delete(Book::first()->path());
            $this->assertCount(0,Book::all());
            $response->assertRedirect('/books');
        }

        public function test_new_author_is_automaticly_added(){
            $this->withoutExceptionHandling();
            $this->post('/books',$this->data());

            $book = Book::first();
            $author = Author::first();
            $this->assertEquals($author->id,$book->author_id);
            $this->assertCount(1,Author::all());
        }

    /**
     * @return array
     */
    private function data(): array
    {
        return [
            'title' => "cool book title",
            'author_id' => 'victor',
        ];
    }
}

