<?php

/**
 * Class for the errormail setting to show in settings.
 *
 * @author Thomas Skerbis
 *
 * @package redaxo\errormail
 *
 * @internal
 */
class rex_system_setting_errormail_intval extends rex_system_setting
{
    private $key;

    /**
     * Constructor.
     *
     * @param string $key Key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

 public function getField()
    {

$field = new rex_form_select_element();

$field->setAttribute('class', 'form-control selectpicker');
$field->setLabel(rex_i18n::msg('system_setting_' . $this->key));
$select = $field->getSelect();
$select->addOption(rex_i18n::msg('errormail_disabled'), 0);
$select->addOption(rex_i18n::msg('errormail_15min'), 900);
$select->addOption(rex_i18n::msg('errormail_30min'), 1800);
$select->setSelected(rex_config::get('errormail', $this->key, 1));

     return $field;
  }   


    public function setValue($value)
    {
        $value = (int) $value;
        $article = rex_article::get($value);

        rex_config::set('errormail', $this->key, $value);
        return true;
    }
}
