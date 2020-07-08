<?php


namespace Derralf\Elements\Featurelist\Model;

use Derralf\Elements\Featurelist\Element\ElementFeaturelistHolder;
use DNADesign\Elemental\Forms\TextCheckboxGroupField;
use Sheadawson\Linkable\Forms\LinkField;
use Sheadawson\Linkable\Models\Link;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Versioned\Versioned;


class ElementFeatureListItem extends DataObject
{


    private static $table_name = 'ElementFeatureListItem';

    private static $singular_name = 'Feature';
    private static $plural_name = 'Features';
    private static $description = '';


    private static $extensions = [
        Versioned::class
    ];

    private static $db = [
        'Title'   => 'Varchar(255)',
        'Content' => 'HTMLText',
        'Sort'    => 'Int'
    ];

    private static $has_one = [
        'Holder'       => ElementFeaturelistHolder::class,
        'Image'        => Image::class,
        'ReadMoreLink' => Link::Class
    ];

    private static $has_many = [
        //'MyOtherDataObjects' => MyOtherDataObject::class
    ];

    private static $many_many = [];

    private static $belongs_many_many = [];

    private static $owns = [
        'Image',
    ];

    private static $defaults = [
    ];

    private static $use_subtitle = false;

    private static $default_sort = 'Sort ASC';

    private static $field_labels = [
        'Title'                   => 'Titel',
        'Content.LimitCharacters' => 'Inhalt',
        'Content'                 => 'Inhalt',
        'Image'                   => 'Bild',
        'Image.CMSThumbnail'      => 'Bild',
        'ReadMoreLink'            => 'Link',
        'ReadMoreLink.LinkURL'    => 'Link',
        'Sort'                    => 'Sortierung'
    ];

    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Title']                        = _t(__CLASS__ . '.TitleLabel',        'Title');
        $labels['Content']                      = _t(__CLASS__ . '.ContentLabel',      'Content');
        $labels['Content.LimitCharacters']      = _t(__CLASS__ . '.ContentLabel',      'Content');
        $labels['Image']                        = _t(__CLASS__ . '.ImageLabel',        'Image');
        $labels['Image.CMSThumbnail']           = _t(__CLASS__ . '.ImageLabel',        'Image');
        $labels['ReadMoreLink']                 = _t(__CLASS__ . '.ReadMoreLinkLabel', 'ReadMoreLink');
        $labels['ReadMoreLink.LinkURL']         = _t(__CLASS__ . '.ReadMoreLinkLabel', 'ReadMoreLink');
        $labels['Sort']                         = _t(__CLASS__ . '.SortLabel',         'Sort');
        return $labels;
    }


    private static $summary_fields = [
        'Image.CMSThumbnail',
        'Title',
        'Content.LimitCharacters',
        'ReadMoreLink.LinkURL'
    ];

    private static $searchable_fields = [
        'Title'
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {

            // Remove relationship fields
            $fields->removeByName('Sort');

            // Content
            $fields->dataFieldByName('Content')->setRows(8);

            // ReadMoreLink
            $ReadMoreLink = LinkField::create('ReadMoreLinkID', 'Link');
            $fields->replaceField('ReadMoreLinkID', $ReadMoreLink);


            // Image Upload konfigurieren
            // --------------------------------------------------------------------------------
            $Image = new UploadField('Image', 'Bild');
            $Image->setFolderName('element-featurelist');
            $Image->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
            $Image->getValidator()->setAllowedMaxFileSize((2 * 1024 * 1024));  // 2MB
            $Image->setDescription('Optional: Bild für Anzeige hinterlegen<br>Erlaubte Dateiformate: jpg, png, gif<br>Erlaubte Dateigröße: max. 2MB<br>Bildgröße/Format: für das Vorschaubild wird automatisch ein Ausschnitt erstellt/errechnet (Format/seitenverhältnis durch Template festgelegt)<br>Bei Bedarf kann der Focus für das Vorschau-Bild gesetzt werden: Bild > Bearbeiten > Focus Point setzen > speichern<br>Achtung! Bild speichern und Datensatz speichern sind verschiedene Buttons/Funktionen');
            $fields->replaceField('Image', $Image);


        });

        $fields = parent::getCMSFields();
        return $fields;
    }

    public function ShowImage() {
        if ($this->Holder()->exists() && $this->Holder()->HideFeatureImages) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function ReadmoreLinkClass() {
        return $this->config()->get('readmore_link_class');
    }


    /**
     * @return null
     */
    public function getPage()
    {
        $page = null;

        if ($this->Holder()->exists()) {
            if ($this->Holder()->hasMethod('getPage')) {
                $page = $this->Holder()->getPage();
            }
        }
        return $page;

    }

    /**
     * Basic permissions, defaults to page perms where possible.
     *
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null)
    {
        $extended = $this->extendedCan(__FUNCTION__, $member);
        if ($extended !== null) {
            return $extended;
        }

        if ($page = $this->getPage()) {
            return $page->canView($member);
        }

        return (Permission::check('CMS_ACCESS', 'any', $member)) ? true : null;
    }

    /**
     * Basic permissions, defaults to page perms where possible.
     *
     * @param Member $member
     *
     * @return boolean
     */
    public function canEdit($member = null)
    {
        $extended = $this->extendedCan(__FUNCTION__, $member);
        if ($extended !== null) {
            return $extended;
        }

        if ($page = $this->getPage()) {
            return $page->canEdit($member);
        }

        return (Permission::check('CMS_ACCESS', 'any', $member)) ? true : null;
    }

    /**
     * Basic permissions, defaults to page perms where possible.
     *
     * Uses archive not delete so that current stage is respected i.e if a
     * element is not published, then it can be deleted by someone who doesn't
     * have publishing permissions.
     *
     * @param Member $member
     *
     * @return boolean
     */
    public function canDelete($member = null)
    {
        $extended = $this->extendedCan(__FUNCTION__, $member);
        if ($extended !== null) {
            return $extended;
        }

        if ($page = $this->getPage()) {
            return $page->canArchive($member);
        }

        return (Permission::check('CMS_ACCESS', 'any', $member)) ? true : null;
    }

    /**
     * Basic permissions, defaults to page perms where possible.
     *
     * @param Member $member
     * @param array $context
     *
     * @return boolean
     */
    public function canCreate($member = null, $context = array())
    {
        $extended = $this->extendedCan(__FUNCTION__, $member);
        if ($extended !== null) {
            return $extended;
        }

        return (Permission::check('CMS_ACCESS', 'any', $member)) ? true : null;
    }




}
