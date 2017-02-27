<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace GoetasWebservices\Xsd\XsdToPhp\Php\DocBlock\Tag;

use Zend\Code\Generator\DocBlock\Tag\AbstractTypeableTag;
use Zend\Code\Generator\DocBlock\Tag\TagInterface;


class VarTag extends AbstractTypeableTag  implements TagInterface
{
    /**
     * @var string
     */
    protected $propertyName = null;

    /**
     * @param string $propertyName
     * @param array $types
     * @param string $description
     */
    public function __construct($propertyName = null, $types = [], $description = null)
    {
        if (!empty($propertyName)) {
            $this->setPropertyName($propertyName);
        }

        parent::__construct($types, $description);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'property';
    }

    /**
     * @return string
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * @param string $propertyName
     * @return self
     */
    public function setPropertyName($propertyName)
    {
        $this->propertyName = ltrim($propertyName, '$');

        return $this;
    }

    /**
     * @return string
     */
    public function generate()
    {
        $output = '@var'
            .((!empty($this->types)) ? ' '.$this->getTypesAsString() : '')
            .((!empty($this->propertyName)) ? ' $'.$this->propertyName : '')
            .((!empty($this->description)) ? ' '.$this->description : '');

        return $output;
    }
}
