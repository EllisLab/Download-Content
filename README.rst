########################################
Download Content ExpressionEngine plugin
########################################

Simply place the plugin tag around the content that you wish to send to the
browser as a file download.  Please note that when this plugin tag is
encountered, all processing on the template will immediately cease and
whatever state the content is in will be sent to the browser.  So avoid
using global variables, advanced conditionals, embedded templates, or other
tags that would be parsed after the plugin.

**********
Parameters
**********

filename=
=========

the file name to use for the download

*******
Example
*******

::

	{exp:content_download filename="foo.txt"}
	Some random content, maybe from a weblog tag.
	{/exp:content_download}