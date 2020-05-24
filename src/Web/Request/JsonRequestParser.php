<?php

declare(strict_types = 1);

namespace GOG\Web\Request;

use Generator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class JsonRequestParser implements EventSubscriberInterface
{
    /**
     * @return Generator<string, string>
     */
    public static function getSubscribedEvents(): Generator
    {
        yield KernelEvents::REQUEST => 'parseJson';
    }

    public function parseJson(RequestEvent $event): void
    {
        if ($event->getRequest()->getContentType() !== 'json') {
            return;
        }

        $data = json_decode((string) $event->getRequest()->getContent(), true, 512, JSON_THROW_ON_ERROR);

        if (!is_array($data)) {
            throw new BadRequestHttpException('Invalid JSON');
        }

        $event->getRequest()->request->replace($data);
    }
}
