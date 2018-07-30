The default Micro Nav Buttons Panel is comprised of a title, text content, and an array of CTA buttons.

## Usage

Maybe you need a custom, single-use navigation or some CTAs without all the extra flare of images, titles and descriptions? This panel works well for adding a suplimentary navigation section to a page or post without registering a new menu, or as a CTA group of just buttons.

## Fields

### `title`
* label: `Title`
* type: `Text`

### `description`
* label: `Description`
* type: `TextArea`
* richtext: `true`

### `items`
* label: `Items`
* type: `Repeater`
* min: `2`
* max: `4`

### `item_cta`
* label: `Item Call To Action Link`
* type: `Link`

## Components

### [Button](/components_docs/button)
* used by: `Content Block`
* panel field: `item_cta`