<?php

//require_once dirname(__FILE__) .'/../../src/utils/HTTP.php';
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-02 at 13:21:48.
 */
class HTTPTest extends PHPUnit_Framework_TestCase {

    /**
     * @var HTTP
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new HTTP;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers HTTP::MethodNotAllowed
     * @todo   Implement testMethodNotAllowed().
     */
    public function testMethodNotAllowed() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * 
     * @covers HTTP::OK
     */
    public function testOKEmpty() {
        // Remove the following lines when you implement this test.
        $this->expectOutputString("OK");
        HTTP::OK('','Content-type: text/plain', false);
    }

    /**
     * 
     * @covers HTTP::OK
     */
    public function testOK() {
        // Remove the following lines when you implement this test.
        $this->expectOutputString("Well done");
        HTTP::OK('Well done','Content-type: text/plain', false);
    }

    /**
     * @covers HTTP::Unauthorized
     */
    public function testUnauthorized() {
        // Remove the following lines when you implement this test.
        $this->expectOutputString("Unauthorized");
        HTTP::Unauthorized('Unauthorized',false);
    }

    /**
     * @covers HTTP::BadRequest
     * @todo   Implement testBadRequest().
     */
    public function testBadRequest() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers HTTP::PreconditionFailed
     * @todo   Implement testPreconditionFailed().
     */
    public function testPreconditionFailed() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers HTTP::NotFound
     * @todo   Implement testNotFound().
     */
    public function testNotFound() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers HTTP::InternalServerError
     * @todo   Implement testInternalServerError().
     */
    public function testInternalServerError() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

}