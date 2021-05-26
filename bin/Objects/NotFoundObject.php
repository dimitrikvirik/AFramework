<?php


namespace Objects;


class NotFoundObject
{
    public function __construct(
        public int $code,
        public string $message
    )
    {
    }
}