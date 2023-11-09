<?php

namespace Ujamii\OpenImmo\Handler;

use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\XmlDeserializationVisitor;
use JMS\Serializer\XmlSerializationVisitor;

/**
 * Class DateTimeHandler
 * @see https://github.com/schmittjoh/serializer/blob/master/doc/handlers.rst
 */
class DateTimeHandler implements SubscribingHandlerInterface
{
    /**
     * @return array|array[]
     */
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                'format'    => 'xml',
                'type'      => 'DateTime',
                'method'    => 'serializeDateTimeToXml',
            ],
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format'    => 'xml',
                'type'      => 'DateTime',
                'method'    => 'deserializeDateTimeToXml',
            ],
        ];
    }

    /**
     * @param array<string> $type
     *
     */
    public function serializeDateTimeToXml(XmlSerializationVisitor $visitor, \DateTime $date, array $type): \DOMText
    {
        return new \DOMText($date->format($type['params'][0]));
    }

    /**
     *
     * @throws \Exception
     */
    public function deserializeDateTimeToXml(XmlDeserializationVisitor $visitor, \SimpleXMLElement $dateAsString): \DateTime
    {
        return new \DateTime((string) $dateAsString);
    }
}
