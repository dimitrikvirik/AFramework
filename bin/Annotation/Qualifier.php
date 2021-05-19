<?php
namespace Annotation;
use Attribute;

#[Attribute] final class Qualifier extends Annotation
{
    /**
     * Annotation constructor.
     * @param string $className
     */
    public function __construct(public string $className){}
}