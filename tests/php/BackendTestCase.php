<?php

namespace FjordTest;

use FjordTest\Traits\TestHelpers;
use FjordTest\Traits\RefreshLaravel;
use FjordTest\Traits\CreateFjordUsers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Dusk\TestCase as OrchestraDuskTestCase;

class BackendTestCase extends OrchestraDuskTestCase
{
    use RefreshDatabase, FjordTestCase, TestHelpers;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // ...
        $this->setUpTraits();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();

        $this->tearDownTraits();
    }

    public static function setUpBeforeClass(): void
    {
        self::setUpBeforeClassTraits();
    }

    public static function tearDownAfterClass(): void
    {
        self::tearDownAfterClassTraits();
    }

    /**
     * Resetting browser environment.
     */
    protected function setUpTheBrowserEnvironment()
    {
    }
    protected function registerShutdownFunction()
    {
    }
    public static function prepare()
    {
    }
}
