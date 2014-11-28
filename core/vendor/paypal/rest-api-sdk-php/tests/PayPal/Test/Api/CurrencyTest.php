<?php

namespace PayPal\Test\Api;

use PayPal\Common\PPModel;
use PayPal\Common\FormatConverter;
use PayPal\Validation\NumericValidator;
use PayPal\Api\Currency;

/**
 * Class Currency
 *
 * @package PayPal\Test\Api
 */
class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Json String of Object Currency
     * @return string
     */
    public static function getJson()
    {
        return '{"currency":"TestSample","value":"12.34"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Currency
     */
    public static function getObject()
    {
        return new Currency(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Currency
     */
    public function testSerializationDeserialization()
    {
        $obj = new Currency(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCurrency());
        $this->assertNotNull($obj->getValue());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Currency $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getCurrency(), "TestSample");
        $this->assertEquals($obj->getValue(), "TestSample");
    }

    /**
     * @depends testSerializationDeserialization
     * @param Currency $obj
     */
    public function testDeprecatedGetters($obj)
    {
    }

    /**
     * @depends testSerializationDeserialization
     * @param Currency $obj
     */
    public function testDeprecatedSetterNormalGetter($obj)
    {

        //Test All Deprecated Getters and Normal Getters
        $this->testDeprecatedGetters($obj);
        $this->testGetters($obj);
    }



}
