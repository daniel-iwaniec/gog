<?php

declare(strict_types = 1);

namespace GOG\Web\Response;

use Generator;
use GOG\Application\Exception\Displayable;
use GOG\Web\CommonResponder;
use GOG\Web\Responder;
use GOG\Web\Responder\Common\JsonResponder;
use IteratorAggregate;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ResponderMatcher implements EventSubscriberInterface
{
    private ContainerInterface $responders;

    /** @var IteratorAggregate<int, CommonResponder> */
    private IteratorAggregate $commonResponders;

    private Responder $responder;

    private bool $debug;

    /**
     * @param IteratorAggregate<int, CommonResponder> $webCommonResponders
     */
    public function __construct(ContainerInterface $webResponders, IteratorAggregate $webCommonResponders, bool $debug)
    {
        $this->responders = $webResponders;
        $this->commonResponders = $webCommonResponders;
        $this->debug = $debug;
    }

    /**
     * @return Generator<string, string>
     */
    public static function getSubscribedEvents(): Generator
    {
        yield KernelEvents::CONTROLLER => 'createResponder';
        yield KernelEvents::VIEW => 'createResponse';
        yield KernelEvents::EXCEPTION => 'createExceptionResponse';
    }

    public function createResponder(ControllerEvent $event): void
    {
        $this->responder = (function (Request $request, object $action) {
            if ($request->query->get('format') === 'json') {
                return $this->responders->get(JsonResponder::class);
            }

            try {
                return $this->responders->get(Responder::class . '\\' . (new ReflectionClass($action))->getShortName());
            } catch (NotFoundExceptionInterface $exception) {
                foreach ($this->commonResponders as $responder) {
                    if ($responder->matches($request)) {
                        return $responder;
                    }
                }
            }

            return $this->responders->get(JsonResponder::class);
        })($event->getRequest(), (object) $event->getController());
    }

    public function createResponse(ViewEvent $event): void
    {
        $event->setResponse($this->responder->respond((object) $event->getControllerResult()));
    }

    public function createExceptionResponse(ExceptionEvent $event): void
    {
        if ($this->debug && !$event->getThrowable() instanceof Displayable) {
            return;
        }

        $event->setResponse($this->responder->respondToException($event->getThrowable()));
    }
}
