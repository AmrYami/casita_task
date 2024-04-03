<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use DB;

abstract class TestCase extends BaseTestCase
{
//    use WithoutMiddleware;
    use CreatesApplication;

//    use DatabaseMigrations;
//    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
//        $this->withoutMiddleware();

        Artisan::call('config:clear');


        Artisan::call('migrate');
        if (!User::first()) {
            $this->seed();
        }
    }

    // public function tearDown(): void {
    //     parent::tearDown();
    //     DB::statement('drop database casita_task_test;');
    // }
}
