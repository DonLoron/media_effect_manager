<? /* @var $this rex_fragment */ ?>

<? $effects = MediaEffectManagerHelper::getMediaManagerEffectArray(); ?>

<fieldset class="effectVariables">
  <legend>Standard Vars</legend>
  <?
  $innerFormElements = [];

  if(isset($effects[$this->effectShortName])) {
    foreach($effects[$this->effectShortName]->getParams() as $k => $param) {

      $n = [];

      switch($param["type"]) {
        case 'select':

          $options = "";
          foreach($param['options'] as $optionsValue => $optionsText) {
            $options .= "<option value=\"$optionsValue\"" . ($this->savedEffectValues['options'][$param['name']] == $optionsValue || $param['default'] == $optionsText ? 'selected' : '') . ">" . $optionsText . "</option>";
          }

          $n['label'] = "<label for=\"media_set_title\">$param[label]</label>";
          $n['field'] = "<select class='form-control' type=\"text\" id=\"media_set_title\" name=\"mediatypeSet[defaultEffects][{$this->formIndex}][options][$param[name]]\">$options</select>";

          break;
        default:

          $n['label'] = "<label for=\"media_set_title\">$param[label]</label>";
          $n['field'] = "<input class='form-control' type=\"text\" id=\"media_set_title\" name=\"mediatypeSet[defaultEffects][{$this->formIndex}][options][$param[name]]\" value=\"{$this->savedEffectValues['options'][$param['name']]}\">";

          break;
      }

      $innerFormElements[] = $n;
    }
  }

  $fragment = new rex_fragment();
  $fragment->setVar("elements", $innerFormElements, false);
  echo $fragment->parse("core/form/form.php");
  ?>
</fieldset>