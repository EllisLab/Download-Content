<?php
/*
Copyright (C) 2011 EllisLab, Inc.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
ELLISLAB, INC. BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

Except as contained in this notice, the name of EllisLab, Inc. shall not be
used in advertising or otherwise to promote the sale, use or other dealings
in this Software without prior written authorization from EllisLab, Inc.
*/

$plugin_info = array(
                 'pi_name'          => 'Download Content',
                 'pi_version'       => '2.0',
                 'pi_author'        => 'EllisLab Development Team',
                 'pi_author_url'    => 'http://ellislab.com/',
                 'pi_description'   => 'Takes the content within the tag pair and forces a file download in the web browser with its contents',
                 'pi_usage'         => Download_content::usage()
               );


class Download_content {

    public $return_data;

    /**
     * Download content
     *
     * @access	public
     * @return	void
     */
    function __construct()
    {
		$this->EE =& get_instance();

		$data = trim($this->EE->TMPL->tagdata);
		$filename = $this->EE->TMPL->fetch_param('filename');

		if ($filename == '')
		{
			$this->EE->TMPL->log_item('No filename given, aborting download');
			return FALSE;
		}
	
		$this->EE->load->helper('download');
		force_download($filename, $data);
    }

    // --------------------------------------------------------------------
    
 	/**
 	 *
 	 * Plugin Usage
 	 *
 	 * @access	public
 	 * @return	type
 	 */
 	function usage()
 	{
		return <<<PHART
Simply place the plugin tag around the content that you wish to send to the
browser as a file download.  Please note that when this plugin tag is
encountered, all processing on the template will immediately cease and
whatever state the content is in will be sent to the browser.  So avoid
using global variables, advanced conditionals, embedded templates, or other
tags that would be parsed after the plugin.

PARAMS
filename=	the file name to use for the download

{exp:content_download filename="foo.txt"}
Some random content, maybe from a channel tag.
{/exp:content_download}
PHART;
 	}

 	// --------------------------------------------------------------------
 	
}
// END CLASS

/* End of file pi.download_content.php */
/* Location: ./system/expressionengine/download_content/pi.download_content.php */