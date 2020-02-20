# iDai Theme Plugin

## Installation
In order to install the theme, download or clone it into the "plugins/themes/" folder. You need to make sure that the "idai" folder within the plugin is either being copied or linked to the public folder of your OJS installation. Linking is the preferred method as it allows updates to be available directly without copying or modifying the files within the public folder.

```
ln -s plugins/themes/idaitheme/idai public/idai
```

After installation and activation you need to choose the "iDai Theme Plugin" from the dropdown menu from the Appearance settings pane within the Website Settings and apply these changes. This is also necessary when the plugin received an update due to the fact that OJS only calls the LESS-Compiler during that process. Once the Compiler successfully compiled the LESS styles, OJS will solely rely on the compiled CSS stylesheet.

## Usage
The Theme is setup to make use of hero images. The website logos are being reused for this purpose and can be uploaded in the backend. UI languages are automatically being added to the language picker. 

## Hardcoded hyperlinks to iDAI pages
The header template has been modified in order to link directly to other iDAI sites. You can find this template under `templates/frontend/components/header.tpl`.


## Adding static sites
Additional static sites can be created through the backend by adding a new navigation entry with a new site. Do not use the static pages plugin as the HTML structure will be different. The template that is being used by adding custom menu entry pages has been modified to fit the layout.

Do not use the Static Pages Plugin!

Do not add another `<h1></h1>`! Any website should only have one headline of that level which will automatically be added by OJS.

## Note
This theme does not implement sidebars. Even if sidebar blocks are being enabled in the backend, the theme will set their visibility to none. The theme is not meant for usage with the announcement system. Keep it deactivated. Announcements have been deliberately deactivated as they have not been fully tested at this point and are not being used by iDAI.

Some Buttons may have strange translated captions that might break the button layout as they differ vastly in length in comparison to the original English captions (i.e. the register button in German). You may need to apply modifications.