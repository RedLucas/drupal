<?php

namespace Drupal\vuejs_table\Controller;

use Drupal\Core\Entity\EntityStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Drupal\rest\Plugin\Type\ResourcePluginManager;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Routing\RouteBuilderInterface;
use Drupal\Core\Url;

class TableSerializer implements ContainerInjectionInterface {

  public static function create(ContainerInterface $container) {
    return new static();
  }

  public function TableSerialize(integer $table_id, Request $request) {
    ksm($request);
    return new JsonResponse();
  }

}
