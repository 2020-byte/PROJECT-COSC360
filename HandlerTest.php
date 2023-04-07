<?php
use PHPUnit\Framework\TestCase;
require_once 'session_handler.php';

class ReviewHandlerTest extends TestCase {

    protected function setUp(): void {
        // Start the session before each test
        session_start();
    }

    public function testIsLoggedIn() {
        // Test the isLoggedIn() function when user is logged in
        $_SESSION['user_id'] = 1;
        $_SESSION['status'] = 1;
        $this->assertTrue(isLoggedIn());
      
        // Test the isLoggedIn() function when user is not logged in
        unset($_SESSION['user_id']);
        $this->assertFalse(isLoggedIn());
      
        // Test the isLoggedIn() function when user status is 0
        $_SESSION['user_id'] = 1;
        $_SESSION['status'] = 0;
        $this->assertFalse(isLoggedIn());
    }

    protected function tearDown(): void {
        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();
    }

}
?>