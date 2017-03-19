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

class VuejsTablePlayground implements ContainerInjectionInterface {

  public static function create(ContainerInterface $container) {
    return new static();
  }

  public function playGround() {

    $build = array(
      '#type' => 'vuejs_table',
      '#caption' => t('Sample Table'),
      '#header' => array(t('Name'), t('Phone')),
    );

    for ($i = 1; $i <= 4; $i++) {
      $build[$i]['#attributes'] = array('class' => array('foo', 'baz'));
      $build[$i]['name'] = array(
        '#markup' => 'link',
      );

      $build[$i]['phone'] = array(
        '#markup' => 'link',
      );
    }

    $build[]['colspan_example'] = array(
      '#plain_text' => 'Colspan Example',
      '#wrapper_attributes' => array('colspan' => 2, 'class' => array('foo', 'bar')),
    );
    ksm($build);

    return $build;
  }

}
