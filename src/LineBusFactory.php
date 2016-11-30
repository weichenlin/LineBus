<?php

namespace AZnC\LineBusType76;


class LineBusFactory
{
    /**
     * @param string $token
     * @param string $secret
     * @return LineBus
     */
    public static function CreateBus($token, $secret)
    {
        $publisher = new EventPublisher(new Request(), $token, $secret);
        $bus = new LineBus($publisher);

        return $bus;
    }
}
