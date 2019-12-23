<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Author;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;
        /*
         * test
         */
        public function test_autohr_can_be_created(){
//            $this->withoutExceptionHandling();
            $this->post('/author',[
                'name'=>'author name',
                'dob'=>'1994-01-15',
            ]);
            $author= Author::all();
            $this->assertCount(1,$author);
            $this->assertInstanceOf(Carbon::class,$author->first()->dob);
            $this->assertEquals('1994-01-15',$author->first()->dob->format("Y-m-d"));


        }
}
