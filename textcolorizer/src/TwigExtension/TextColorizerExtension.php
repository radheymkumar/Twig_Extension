<?php

namespace Drupal\textcolorizer\TwigExtension;

/**
 * Class DefaultService.
 *
 * @package Drupal\demo_module
 */
class TextColorizerExtension extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    //return 'textcolorizer.twig_extension';
    return 'textcolorizer';
  }

  /**
   * Generates a list of all Twig filters that this extension defines.
   */
  public function getFilters() {
    return [
      new \Twig_SimpleFilter('colorize', array($this, 'filterColorize'), array('is_safe' => array('html'))),
    ];
  }

  /**
   * In this function we can declare the extension function.
   */
  public function getFunctions() {
    return [
        new \Twig_SimpleFunction('fetch_user_info', array($this, 'fetchUserInfo'), array('is_safe' => array('html'))),
    ];
  }

  /**
   * Filter to return colorized text
   */
  public static function filterColorize($txt, $color) {
    return '<span style="color: ' . $color . '">Whatever</span>';
    // Twig - {{ "radhey"|colorize('red') }} {{ "Rocks!"|colorize('#00ff00') }}
  }

  /**
   * Functions to return data
   */
  public static function fetchUserInfo($nid) {

    $node = \Drupal\node\Entity\Node::load($nid);
    $uid = $node->uid->getString();
    $account = \Drupal\user\Entity\User::load($uid);

    $html = '<p>User Name : '. $account->getUsername() .'</p>';
    $html .='<p>Email Address : '. $account->getEmail() .'</p>';

    return  $html;
    // Twig - {{ fetch_user_info(node.nid.value) }}
  }

}
