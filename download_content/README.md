# Download Content Plugin

This plugin takes the content within the tag pair and forces a file download in the web browser with its contents, allowing you to turn template output into downloadable files.

## Usage

### {exp:download_content filename="foo.txt"}

To use this plugin, place the plugin tag around the content that you wish to send to the browser as a file download, supplying the desired file name. Optionally, the file can also be saved to disk on the server.

**Note:** When this plugin tag is processed, all other processing on the template will immediately cease and whatever state the content is in will be sent to the browser. This may influence where you use this tag in relation to your layouts, for instance.

#### Example Usage

```
{exp:download_content filename="foo.txt"}
    Some random content, maybe from a channel tag.
{/exp:download_content}
```

#### Available Parameters

##### filename

Name of the file you want the browser download to be named.

##### save_to_server_path

Full server path to a writable directory on the server. If the directory does not exist, the plugin will attempt to create it. Overwrites identically named files. If you do not wish to overwrite existing files, ensure that you are using unique filenames. If the plugin is unable to save the file, it will abort and will not prompt a browser download either. To debug, turn on debugging in your Debugging & Output preferences and look for an error in the Template Log.

**Warning:** If you use dynamically unique filenames with this plugin on a publicly accessible template, stored files could grow out of control or even be a target of a DoS attack designed to run your web server out of disk space. It is recommended that if you save to a server path at all that you have external mechanisms in place to manage the permanent storage of these files.

## Change Log

### 3.0

- Updated plugin to be 3.0 compatible
- Added ability to save copies of the file to the server
