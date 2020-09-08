<?php 

use \PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    protected $user;

    protected function setUp(): void
    {
        $this->user = new User;
    }

    function testFullnameIsEmptyByDefault() {
        $this->assertEquals("", $this->user->getFullName());
    }

    function testGetFullname() {

        $this->user->firstname = 'Iszuddin';
        $this->user->lastname = 'Ismail';

        $this->assertEquals("Iszuddin Ismail", $this->user->getFullName());

    }

    function testSetNameByConstructor() {
        $this->user = new User('Billy', 'Bob');
        $this->assertEquals("Billy Bob", $this->user->getFullName());
    }

    function testSendNotificationReturnTrue() {

        // $mailer = new Mailer;
        $mockMailer = $this->createMock(Mailer::class);
        $mockMailer->method('sendMessage')->willReturn(true);

        $this->user->setMailer($mockMailer);
        $this->user->email = 'dino@websegera.my';
        $this->assertTrue( $this->user->notify() );
    }

    function testSendNotificationWithNoEmailReturnException() {
/*
        $mockMailer = $this->createMock(Mailer::class);
        $mockMailer->method('sendMessage')->willReturn(true);
*/

        $mockMailer = $this->getMockBuilder(Mailer::class)
                            ->setMethods(null)  // tells which functions to stub, null = no stubbing
                            ->getMock();

        $this->user->setMailer($mockMailer);

        $this->expectExceptionMessage("Email is empty");
        $this->user->notify();
    }

    function testSendNotificationInvalidEmailReturnException() {
/*
        $mockMailer = $this->createMock(Mailer::class);
        $mockMailer->method('sendMessage')->willReturn(true);
*/

        $mockMailer = $this->getMockBuilder(Mailer::class)
                            ->setMethods(null)  // tells which functions to stub, null = no stubbing
                            ->getMock();

        $this->user->setMailer($mockMailer);
        $this->user->email = 'dino@websegera';

        $this->expectExceptionMessage("Invalid email address");
        $this->user->notify();

    }

    function testSaveNewUser() {
        
        $this->user->firstname = 'Iszuddin';
        $this->user->lastname = 'Ismail';
        $this->user->email = 'dino@websegera.my';

        $mockDB = $this->setupMockDBSave();

        $this->user->setDB($mockDB);

        $this->assertTrue( $this->user->save() );
    }

    function testExpectExceptionIfFirstNameIsEmptyOnSave() {
        
        $this->user->lastname = 'Ismail';
        $this->user->email = 'dino@websegera.my';

        $mockDB = $this->setupMockDBSave();

        $this->user->setDB($mockDB);
        $this->expectExceptionMessage("Cannot save if first name is empty");

        $this->user->save();
    }

    function testExpectExceptionIfLastNameIsEmptyOnSave() {
        
        $this->user->firstname = 'Ismail';
        $this->user->email = 'dino@websegera.my';

        $mockDB = $this->setupMockDBSave();

        $this->user->setDB($mockDB);
        $this->expectExceptionMessage("Cannot save if last name is empty");

        $this->user->save();
    }

    function testExpectExceptionIfEmailIsInvalidOnSave() {
        
        $this->user->firstname = 'Iszuddin';
        $this->user->lastname = 'Ismail';
        $this->user->email = 'dino';

        $mockDB = $this->setupMockDBSave();

        $this->user->setDB($mockDB);
        $this->expectExceptionMessage("Cannot save if email is invalid");

        $this->user->save();
    }

    function setupMockDBSave() {
        $sql = "insert into users (firstname, lastname, email) values (
        '{$this->user->firstname}',
        '{$this->user->lastname}',
        '{$this->user->email}'
        )";

        $mockDB = $this->createMock(mysqli::class);
        $mockDB->method('query')
                ->with( $this->equalTo( $sql ) )
                ->willReturn(true);
        return $mockDB;
    }

    function testGetUserIsSuccessful() {

        $result = new class {
            public $sampledata = [
                'firstname' => 'Billy',
                'lastname' => 'Bob',
                'email' => 'billy@bob.com'
            ];            
            public $num_rows =  1; 
            function fetch_assoc(){ 
                return $this->sampledata;
            }
        };
        
        $mockDB = $this->createMock(mysqli::class);
        $mockDB->method('query')
                ->with( $this->anything() )
                ->willReturn($result);

        $this->user->setDB($mockDB);

        $this->user->get(11);

        $this->assertEquals($this->user->firstname, 'Billy');
        $this->assertEquals($this->user->lastname, 'Bob');
        $this->assertEquals($this->user->email, 'billy@bob.com');
        $this->assertEquals($this->user->id, 11);

    }

    function testGetUserExpectExceptionWhenNoUser() {

        $result = new class {
            public $sampledata = [
                'firstname' => 'Billy',
                'lastname' => 'Bob',
                'email' => 'billy@bob.com'
            ];            
            public $num_rows = 0; 
            function fetch_assoc(){ 
                return $this->sampledata;
            }
        };
        
        $mockDB = $this->createMock(mysqli::class);
        $mockDB->method('query')
                ->with( $this->anything() )
                ->willReturn($result);

        $this->user->setDB($mockDB);

        $this->expectExceptionMessage("User not found");

        $this->user->get(11);
        //$this->assertEquals($this->user->firstname, 'Billy');

    }

}