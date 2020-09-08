# ```phpunit``` Command Line
```C:\project> echo @php "%~dp0vendor\phpunit\phpunit\phpunit" %* ```

# Assertion 

## More on assertion functions
https://phpunit.readthedocs.io/en/9.3/assertions.html 

# Naming Your Test Functions

## Use ```test``` Prefix
example, ```public function testTestName() {...}```

## User Doc Block 
```
/*
 * @test
 */

function AddReturnsCorrectValue() {...}
```

# Running Tests

## Using file name
```phpunit tests/UserTest.php```

## Using folder name 
```phpunit tests/``` 

## Using ```--filter``` 
```phpunit tests/ --filter=testAddReturnsCorrectSum```

## Showing Color ```--color```
```phpunit tests/ --color```

# XML Configurations ```phpunit.xml``` 

More information available 
https://phpunit.readthedocs.io/en/9.3/configuration.html

```
<?xml version="1.0" encoding="UTF-8" ?>
<phpunit colors="true"
    verbose="true"
    bootstrap="vendor/autoload.php">
    <testsuites>
        <testsuite name="Test suite">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

# Autoloading Classes with Composer

## PSR-4, Update ```composer.json```

```
    "autoload": {
        "psr-4": {
            "": "src/"
        }
    }
```

## Run Dump Autoload Command

This will generate the bootstrap ```autoload.php``` file.

```composer dump-autoload```

## Create ```src/``` folder

Create the ```src/``` folder, and then move classes into that folder.

# Controlling Your Test Objects / Data

## Dependencies

```
public function testNewQueueIsEmpty() {
    $queue = new Queue;

    $this->assertEquals(0, $queue->getCount());

    return $queue;
}

/**
 * @depends testNewQueueIsEmpty
 */

public function testAnItemIsAddedToTheQueue(Queue $queue) {
    $queue->push('green');
    $this->assertEquals(1, $queue->getCount());
    return $queue;
}
```

## Fixtures

You can have functions to run before and after tests.

```
    // runs before each test
    protected function setUp() : void {
        $this->queue = new Queue;
    }

    // runs after each test
    protected function tearDown() : void {
        unset($this->queue);
    }
```

You can also have functions to run once after a class is loaded and once after all tests has been run.

```
    public static function setUpBeforeClass(): void
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }

    public static function tearDownAfterClass(): void
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }
```

More information is available at 
https://phpunit.readthedocs.io/en/9.3/fixtures.html 

# Dependency Injection with Mock & MockBuilder 



# Dependency Injection with Mockery

```composer require mockery/mockery --dev```

More information and documentation is available here:
http://docs.mockery.io/en/latest/

## Use Mockery With ```tearDown``` 

```
    function tearDown(): void {
        Mockery::close();
    }
```

## Use Mockery with MockeryTestCase 

```
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class ExampleTest extends MockeryTestCase {

    function testNothing() {
        $this->assertTrue(true);
    }

}
```
