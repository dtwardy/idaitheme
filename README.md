# iDai Theme Plugin

## Installation
In order to install the theme, download or clone it into the "plugins/themes/" folder. You need to make sure that the "idai" folder within the plugin is either being copied or linked to the public folder of your OJS installation. Linking is the preferred method as it allows updates to be available directly without copying or modifying the files within the public folder.

```
ln -s plugins/themes/idaitheme/idai public/idai
```

After installation and activation you need to choose the "iDai Theme Plugin" from the dropdown menu from the Appearance settings pane within the Website Settings and apply these changes. This is also necessary when the plugin received an update due to the fact that OJS only calls the LESS-Compiler during that process. Once the Compiler successfully compiled the LESS styles, OJS will solely rely on the compiled CSS stylesheet.