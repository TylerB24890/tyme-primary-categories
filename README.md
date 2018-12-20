# Tyme Primary Categories

A simple WordPress plugin for assigning "Primary Categories" to your posts.<br>Think Yoast's Primary Category feature, but without Yoast ;)

#### WARNING: this plugin is not yet compatible with WordPress 5.0+ (Gutenberg). If you install & activate this plugin Gutenberg **will** be disabled automatically and your editor will return to the Classic WordPress Editor.

Gutenberg support is currently in development. If you would like to help out or contribute, please see the `release/2.0` branch.

### Installation

1. Download this repo into your websites `plugins` directory.
2. Activate the plugin from your wp-admin Dashboard
3. That's it!

### How To Use
As you create/edit posts and assign categories you will see "Set Primary" links next to the category checkbox. Simply click the link and save your post. You can unset your primary selection at anytime by clicking the "Unset Primary" link that replaces the previously mentioned "Set Primary" link.

**Note:** If you have `%category%` in your permalink structure the `%category%` portion **will** be replaced with your "Primary Category" slug. Unsetting the Primary Category will revert the URL to it's previous state. 
