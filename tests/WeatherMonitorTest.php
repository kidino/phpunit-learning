<?php 

use \PHPUnit\Framework\TestCase;

class WeatherMonitorTest extends TestCase {

    function tearDown(): void {
        Mockery::close();
    }

    public function testCorrectAverageIsReturned() {
        $service = $this->createMock( TemperatureService::class );

        $valuemap = [
            [ '12:00', 20 ],
            [ '14:00', 26 ]
        ];

        $service->expects( $this->exactly(2))
                ->method('getTemperature')
                ->will( $this->returnValueMap( $valuemap ) );

        $weather = new WeatherMonitor( $service );
        $avgt = $weather->getAverageTemperature( '12:00', '14:00' );
        $this->assertEquals( 23, $avgt );

    }

    function testCorrectAverageIsReturnedWithMockery() {
        $service = Mockery::mock(TemperatureService::class);

        $service->shouldReceive('getTemperature')
                ->once()
                ->with('12:00')
                ->andReturn(20);

        $service->shouldReceive('getTemperature')
                ->once()
                ->with('14:00')
                ->andReturn(26);

        $weather = new WeatherMonitor( $service );
        $avgt = $weather->getAverageTemperature( '12:00', '14:00' );
        $this->assertEquals( 23, $avgt );

    }

}