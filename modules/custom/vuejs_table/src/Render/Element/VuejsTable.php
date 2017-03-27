<?php

namespace Drupal\vuejs_table\Render\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use Drupal\Component\Utility\Html as HtmlUtility;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Provides a render element for a table.
 *
 * Note: Although this extends FormElement, it can be used outside the
 * context of a form.
 *
 * Properties:
 * - #header: An array of table header labels.
 * - #rows: An array of the rows to be displayed. Each row is either an array
 *   of cell contents or an array of properties as described in table.html.twig
 *   Alternatively specify the data for the table as child elements of the table
 *   element. Table elements would contain rows elements that would in turn
 *   contain column elements.
 * - #empty: Text to display when no rows are present.
 * - #responsive: Indicates whether to add the drupal.responsive_table library
 *   providing responsive tables.  Defaults to TRUE.
 * - #sticky: Indicates whether to add the drupal.tableheader library that makes
 *   table headers always visible at the top of the page. Defaults to FALSE.
 * - #size: The size of the input element in characters.
 *
 * Usage example:
 * @code
 * $form['contacts'] = array(
 *   '#type' => 'table',
 *   '#caption' => $this->t('Sample Table'),
 *   '#header' => array($this->t('Name'), $this->t('Phone')),
 * );
 *
 * for ($i = 1; $i <= 4; $i++) {
 *   $form['contacts'][$i]['#attributes'] = array('class' => array('foo', 'baz'));
 *   $form['contacts'][$i]['name'] = array(
 *     '#type' => 'textfield',
 *     '#title' => $this->t('Name'),
 *     '#title_display' => 'invisible',
 *   );
 *
 *   $form['contacts'][$i]['phone'] = array(
 *     '#type' => 'tel',
 *     '#title' => $this->t('Phone'),
 *     '#title_display' => 'invisible',
 *   );
 * }
 *
 * $form['contacts'][]['colspan_example'] = array(
 *   '#plain_text' => 'Colspan Example',
 *   '#wrapper_attributes' => array('colspan' => 2, 'class' => array('foo', 'bar')),
 * );
 * @endcode
 * @see \Drupal\Core\Render\Element\Tableselect
 *
 * @FormElement("vuejs_table")
 */
class VuejsTable extends Element\Table {
  //
  // /**
  //  * {@inheritdoc}
  //  */
  public function getInfo() {
    $class = get_class($this);
    return array(
      '#header' => array(),
      '#rows' => array(),
      '#empty' => '',
      // Properties for tableselect support.
      '#input' => TRUE,
      '#tree' => TRUE,
      '#tableselect' => FALSE,
      '#sticky' => FALSE,
      '#responsive' => TRUE,
      '#multiple' => TRUE,
      '#js_select' => TRUE,
      '#process' => array(
        array($class, 'processTable'),
      ),
      '#element_validate' => array(
        array($class, 'validateTable'),
      ),
      // Properties for tabledrag support.
      // The value is a list of arrays that are passed to
      // drupal_attach_tabledrag(). Table::preRenderTable() prepends the HTML ID
      // of the table to each set of options.
      // @see drupal_attach_tabledrag()
      '#tabledrag' => array(),
      // Render properties.
      '#pre_render' => array(
        array($class, 'preRenderTable'),
      ),
      '#theme' => 'table',
    );
  }

  //  * @param array $element
  //  *   A structured array containing two sub-levels of elements. Properties used:
  //  *   - #tabledrag: The value is a list of $options arrays that are passed to
  //  *     drupal_attach_tabledrag(). The HTML ID of the table is added to each
  //  *     $options array.
  //  *
  //  * @return array
  //  *
  //  * @see template_preprocess_table()
  //  * @see \Drupal\Core\Render\AttachmentsResponseProcessorInterface::processAttachments()
  //  * @see drupal_attach_tabledrag()
  //  */
  public static function preRenderTable($element) {
  //   foreach (Element::children($element) as $first) {
  //     $row = array('data' => array());
  //     // Apply attributes of first-level elements as table row attributes.
  //     if (isset($element[$first]['#attributes'])) {
  //       $row += $element[$first]['#attributes'];
  //     }
  //     // Turn second-level elements into table row columns.
  //     // @todo Do not render a cell for children of #type 'value'.
  //     // @see https://www.drupal.org/node/1248940
  //     foreach (Element::children($element[$first]) as $second) {
  //       // Assign the element by reference, so any potential changes to the
  //       // original element are taken over.
  //       $column = array('data' => &$element[$first][$second]);
  //
  //       // Apply wrapper attributes of second-level elements as table cell
  //       // attributes.
  //       if (isset($element[$first][$second]['#wrapper_attributes'])) {
  //         $column += $element[$first][$second]['#wrapper_attributes'];
  //       }
  //
  //       $row['data'][] = $column;
  //     }
  //     $element['#rows'][] = $row;
  //   }
  //
  //   // Take over $element['#id'] as HTML ID attribute, if not already set.
  //   Element::setAttributes($element, array('id'));
  //
  //   // Add sticky headers, if applicable.
  //   if (count($element['#header']) && $element['#sticky']) {
  //     $element['#attached']['library'][] = 'core/drupal.tableheader';
  //     // Add 'sticky-enabled' class to the table to identify it for JS.
  //     // This is needed to target tables constructed by this function.
  //     $element['#attributes']['class'][] = 'sticky-enabled';
  //   }
  //   // If the table has headers and it should react responsively to columns hidden
  //   // with the classes represented by the constants RESPONSIVE_PRIORITY_MEDIUM
  //   // and RESPONSIVE_PRIORITY_LOW, add the tableresponsive behaviors.
  //   if (count($element['#header']) && $element['#responsive']) {
  //     $element['#attached']['library'][] = 'core/drupal.tableresponsive';
  //     // Add 'responsive-enabled' class to the table to identify it for JS.
  //     // This is needed to target tables constructed by this function.
  //     $element['#attributes']['class'][] = 'responsive-enabled';
  //   }
  //
  //   // If the custom #tabledrag is set and there is a HTML ID, add the table's
  //   // HTML ID to the options and attach the behavior.
  //   if (!empty($element['#tabledrag']) && isset($element['#attributes']['id'])) {
  //     foreach ($element['#tabledrag'] as $options) {
  //       $options['table_id'] = $element['#attributes']['id'];
  //       drupal_attach_tabledrag($element, $options);
  //     }
  //   }
    ksm($element);
    return $element;
  }

  public function tableJson() {
    ksm(new Request());
    return new JsonResponse();
  }

}
