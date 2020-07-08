# SilverStripe Elemental Feature List

A content block to display short headlines/questions and texts/answers along with icons/images for the silverstripe-elemental module.  
(private project, no help/support provided)

## Requirements

* SilverStripe CMS ^4.3
* dnadesign/silverstripe-elemental ^4.0
* sheadawson/silverstripe-linkable ^2.0@dev


## Suggestions
* derralf/elemental-styling

Modify `/templates/Derralf/Elements/Featurelist/Includes/Title.ss` to your needs when using StyledTitle from derralf/elemental-styling.


## Installation

- Install the module via Composer
  ```
  composer require derralf/elemental-featurelist
  ```


## Configuration

A basic/default config. Add this to your **mysite/\_config/elements.yml**



```

---
Name: elementalfeaturelist
---

Derralf\Elements\Featurelist\Element\ElementFeaturelistHolder:
  ## disable StyledTitle
  #title_tag_variants: null
  #title_alignment_variants: null
  # styles
  style_default_description: 'defdault: 2 columns'
  styles:
    TwoColumns: '2 columns'

Derralf\Elements\Featurelist\Model\ElementFeatureListItem:
  readmore_link_class: 'btn btn-primary btn-readmore'

```

Additionally you may apply the default styles:

```
# add default styles
DNADesign\Elemental\Controllers\ElementController:
  default_styles:
    # boptstrap 3 example styles
    - derralf/elemental-featurelist:client/dist/styles/frontend-default.css
```

See Elemental Docs for [how to disable the default styles](https://github.com/dnadesign/silverstripe-elemental#disabling-the-default-stylesheets).

### Adding your own templates

You may add your own templates/styles like this:

```
Derralf\Elements\Featurelist\Element\ElementFeaturelistHolder:
  styles:
    MyCustomTemplate: "new customized special Layout"
```

...and put a template named `ElementFeaturelistHolder_MyCustomTemplate.ss`in `themes/{your_theme}/templates/Derralf/Elements/Featurelist/Element/`  
**and/or**
add styles for `.derralf__elements__featurelist__element__elementfeaturelistholder .mycustomtemplate` to your style sheet



## Template Notes

Included templates are based on Bootstrap 3+ but require extra/additional styling (see included stylesheet).

- Optionaly, you can require basic CSS stylings provided with this module to your controller class like:
  **mysite/code/PageController.php**
  ```
      Requirements::css('derralf/elemental-featurelist:client/dist/styles/frontend-default.css');
  ```
  or copy over and modify `client/src/styles/frontend-default.scss` in your theme scss


## Screen Shots

(not available)


