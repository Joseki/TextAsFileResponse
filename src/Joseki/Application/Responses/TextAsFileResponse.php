<?php

/**
 * This file is part of Joseki (https://github.com/Joseki)
 * Copyright (c) 2014 Miroslav Paulík (http://mirapaulik.cz)
 */

namespace Joseki\Application\Responses;

use Nette\Application\IResponse;
use Nette\Application\UI\ITemplate;
use Nette\Http\IRequest;
use Nette\Http\IResponse as HttpIResponse;
use Nette\Object;

class TextAsFileResponse extends Object implements IResponse
{
    /** @var  string */
    private $name;

    /** @var string */
    private $source;

    /** @var string|null */
    private $contentType;

    /** @var bool */
    private $forceDownload;



    function __construct($source, $name, $contentType = null, $forceDownload = true)
    {
        $this->name = $name;
        $this->source = $source;
        $this->contentType = $contentType ? : 'application/octet-stream';
        $this->forceDownload = $forceDownload;
    }



    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }



    /**
     * @return null|string
     */
    public function getContentType()
    {
        return $this->contentType;
    }



    function send(IRequest $httpRequest, HttpIResponse $httpResponse)
    {
        $httpResponse->setContentType($this->contentType);
        $httpResponse->setHeader(
            'Content-Disposition',
            ($this->forceDownload ? 'attachment' : 'inline') . '; filename="' . $this->name . '"'
        );

        if ($this->source instanceof ITemplate) {
            $this->source->render();
        } else {
            echo $this->source;
        }
    }
}
