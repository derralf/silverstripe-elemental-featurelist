<?php

namespace Derralf\Elements\Featurelist\Element;


use Derralf\Elements\Featurelist\Model\ElementFeatureListItem;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\Tab;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\SSViewer;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class ElementFeaturelistHolder extends BaseElement
{


    public function getType()
    {
        return self::$singular_name;
    }

    private static $icon = 'font-icon-block-content';

    private static $table_name = 'ElementFeaturelistHolder';

    private static $singular_name = 'Feature List';
    private static $plural_name = 'Feature Lists';
    private static $description = '';

    private static $db = [
        'HTML'              => 'HTMLText',
        'HideFeatureImages' => 'Boolean',
        'UseToggleButton'   => 'Boolean',
        'ToggleButtonLabel' => 'Varchar'
    ];


    private static $has_one = [
    ];

    private static $has_many = [
        'Features' => ElementFeaturelistItem::class
    ];

    private static $many_many = [
    ];

    // this adds the SortOrder field to the relation table.
    private static $many_many_extraFields = [
    ];

    private static $belongs_many_many = [];

    private static $owns = [
        //'Teasers'
    ];

    private static $inline_editable = false;

    private static $defaults = [
    ];

    private static $colors = [];


    private static $field_labels = [
        'Title' => 'Titel',
        'Sort' 	=>	'Sortierung'
    ];

    public function updateFieldLabels(&$labels)
    {
        parent::updateFieldLabels($labels);
        $labels['HTML']    = _t(__CLASS__ . '.ContentLabel', 'Content');
        $labels['Teasers'] = _t(__CLASS__ . '.TeasersLabel', 'Teasers');
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {

            // Style: Description for default style (describes Layout thats used, when no special style is selected)
            $Style = $fields->dataFieldByName('Style');
            $StyleDefaultDescription = $this->config()->get('style_default_description', Config::UNINHERITED);
            if ($Style && $StyleDefaultDescription) {
                $Style->setDescription($StyleDefaultDescription);
            }

            // Optionen/Checkboxen in anderen Tab schieben
            $fields->addFieldToTab('Root.Features', $fields->dataFieldByName('HideFeatureImages'), 'Features');
            $fields->addFieldToTab('Root.Features', $fields->dataFieldByName('UseToggleButton'), 'Features');
            $fields->addFieldToTab('Root.Features', $fields->dataFieldByName('ToggleButtonLabel'), 'Features');


            // Buttton Label in anderen Tab schieben
            //'HideFeatureImages' => 'Boolean',
            //'UseToggleButton'   => 'Boolean',
            //'ToggleButtonLabel' => 'Varchar'


            // Gridfield erweitern
            if ($this->ID) {
                $FeatureGridfield = $fields->dataFieldByName('Features');
                $FeatureGridfieldConfig = $FeatureGridfield->getConfig();
                $FeatureGridfieldConfig->removeComponentsByType('GridFieldDeleteAction');
                $FeatureGridfieldConfig->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
                $FeatureGridfieldConfig->addComponent(new GridFieldAddExistingSearchButton());
                $FeatureGridfieldConfig->addComponent(new GridFieldOrderableRows('Sort'));
            }

        });
        $fields = parent::getCMSFields();

        return $fields;
    }

}
